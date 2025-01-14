<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Models\Relation;
use App\Models\UserContactData;
use App\Models\UserSmsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $UserService;

    public function __construct()
    {
        $this->UserService = new UserService();
    }

    public function getAllUsers(Request $request)
    {
        Session::flash('personal_info', true);

        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->UserService->fetchRecord($data);

            if ($request->has('loan_status') && $request->loan_status != "null") {
                $loanStatus = $request->loan_status;
                $record = $record->where('loan_status', $loanStatus);
            }
            
            return DataTables::of($record)
                ->addColumn('is_active', function ($rec) {
                    if ($rec->is_active == 1) {
                        return '<div><span class="tb-status text-success" onclick="changeStatus(' . $rec->id . ',0)">Active</span></div>';
                    } else {
                        return '<div><span class="tb-status text-danger" onclick="changeStatus(' . $rec->id . ',1)">Inactive</span></div>';
                    }
                })
                ->rawColumns(['is_active'])->make(true);
        }
        return view('users.all');
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = User::where('id', $id)->update([
                'is_active' => $status,
            ]);
            if ($response) {
                $message = "Inactive status change successfully";
                if ($status == 1) {
                    $message = "Active status change successfully";
                }
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid Data']);
    }

    public function changeNotificationStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = User::where('id', $id)->update([
                'is_notification' => $status,
            ]);
            if ($response) {
                $message = "Notification disabled successfully";
                if ($status == 1) {
                    $message = "Notification enabled successfully";
                }
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid Data']);
    }

    public function getUserDetails(Request $request)
    {
        $id = $request->id;
        $data = $this->UserService->fetch($id);
        $relations = Relation::all();

        $referredDetails = User::where('referred_by', $id)->orderBy('id', 'DESC')->get();
        $contacts = UserContactData::where('user_id', $id)->orderBy('id', 'DESC')->get();

        $sms = UserSmsData::where('user_id', $id)
                  ->orderBy('address', 'ASC')
                  ->orderBy('date', 'ASC')
                  ->orderBy('id', 'ASC')
                  ->get();

        if ($request->ajax()) {
            if ($request->datatable == 'referred') {
                return DataTables::of($referredDetails)->make(true);
            } elseif ($request->datatable == 'contacts') {
                return DataTables::of($contacts)->make(true);
            } elseif ($request->datatable == 'sms') {
                return DataTables::of($sms)->make(true);
            }
        }
        return view('users.details', compact('data', 'relations'));
    }

    public function updatePersonalInfo(Request $request)
    {
        Session::flash('personal_info', true);
        $phoneNumber = auth()->user()->phone_number;

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'alternate_phone_number' => [
                'nullable',
                'string',
                'regex:/^[0-9]{10}$/',
                'different:phone_number',
                function ($attribute, $value, $fail) use ($phoneNumber) {
                    if ($value == $phoneNumber) {
                        $fail('The alternate phone number and primary phone number must be different.');
                    }
                },
            ],
            'dob' => 'required|date_format:Y-m-d',
            'current_address' => 'required|string',
            'pincode' => 'required|regex:/^[0-9]{6}$/',
            'employment_type' => 'required|string',
            'relationship_status' => 'required',
        ], [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'alternate_phone_number.required' => 'The alternate phone number field is required.',
            'alternate_phone_number.digits' => 'The alternate phone number must be exactly 10 digits.',
            'alternate_phone_number.numeric' => 'The alternate phone number must be a number.',
            'dob.required' => 'The date of birth field is required.',
            'dob.date' => 'The date of birth must be a valid date.',
            'employment_type.required' => 'The employment type field is required.',
            'relationship_status.required' => 'The relationship status field is required.',
            'current_address.required' => 'The current address field is required.',
            'pincode.required' => 'The pincode field is required.',
            'pincode.digits' => 'The pincode must be exactly 6 digits.',
            'pincode.numeric' => 'The pincode must be a number.',
        ]);
        
        $data = $request->all();
        $data['id'] = $request->id;

        $response = $this->UserService->updatePersonalInfo($data);
        if ($response) {
           return redirect()->back()->with('success', 'Personal details updated successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateRelativeInfo(Request $request)
    {
        Session::flash('personal_info', true);
        $phoneNumber = auth()->user()->phone_number;

        $request->validate([
            'relative1_name' => 'required|string',
            'relative1_relation_id' => 'required|integer',
            'relative1_phone_number' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
                'different:relative2_phone_number',
                'different:phone_number',
                function ($attribute, $value, $fail) use ($phoneNumber) {
                    if ($value == $phoneNumber) {
                        $fail('The relative1 phone number and primary phone number must be different.');
                    }
                },
                'different:alternate_phone_number',
            ],
            'relative2_name' => 'required|string',
            'relative2_relation_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $restrictedRelations = Relation::whereIn('relation_name', ['Mother', 'Father', 'Husband', 'Wife'])->pluck('id')->toArray();

                    if (in_array($request->relative1_relation_id, $restrictedRelations) && $value == $request->relative1_relation_id) {
                        $fail('The relative2 relation cannot be the same as relative1 if it is Mother, Father, Husband, or Wife.');
                    }
                },
            ],
            'relative2_phone_number' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
                'different:relative1_phone_number',
                'different:phone_number',
                function ($attribute, $value, $fail) use ($phoneNumber) {
                    if ($value == $phoneNumber) {
                        $fail('The relative2 phone number and primary phone number must be different.');
                    }
                },
                'different:alternate_phone_number',
            ],
        ], [
            'relative1_name.required' => 'The relative 1 name field is required.',
            'relative1_relation_id.required' => 'The relative 1 relation field is required.',
            'relative1_phone_number.required' => 'The relative 1 phone number field is required.',
            'relative1_phone_number.digits' => 'The relative 1 phone number must be exactly 10 digits.',
            'relative1_phone_number.numeric' => 'The relative 1 phone number must be a number.',
            'relative2_name.required' => 'The relative 2 name field is required.',
            'relative2_relation_id.required' => 'The relative 2 relation is required.',
            'relative2_phone_number.required' => 'The relative 2 phone number field is required.',
            'relative2_phone_number.digits' => 'The relative 2 phone number must be exactly 10 digits.',
            'relative2_phone_number.numeric' => 'The relative 2 phone number must be a number.',
        ]);

        $data = $request->all();
        $data['id'] = $request->id;

        $response = $this->UserService->updateRelativeInfo($data);
        if ($response) {
           return redirect()->back()->with('success', 'Relative details updated successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateLoanLimitInfo(Request $request)
    {
        Session::flash('loan_limit_info', true);
        $request->validate([
            'income_amount' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_pincode' => 'required',
            'company_city' => 'required',
            'credit_limit' => 'required',
            // 'salary_slip' => 'nullable|mimes:pdf',
            'bank_statement' => 'nullable|mimes:pdf'
        ], [
            'income_amount.required' => 'The income amount field is required.',
            'company_name.required' => 'The company name field is required.',
            'company_address.required' => 'The company address field is required.',
            'company_pincode.required' => 'The company pincode field is required.',
            'company_city.required' => 'The company city field is required.',
            'credit_limit.required' => 'The credit limit field is required.',
            // 'salary_slip.mimes' => 'The salary slip must be pdf file format.',
            'bank_statement.mimes' => 'The bank statement must be pdf file format.'
        ]);

        $user = $this->UserService->fetchUser($request->id);
        $userId = $request->id;

        // $salarySlipPath = NULL;
        // if ($request->hasFile('salary_slip')) {
        //     if ($user && $user->salary_slip) {
        //         Storage::delete('public/' . $user->salary_slip);
        //     }

        //     $salary_slip = $request->file('salary_slip');
        //     $number = rand(1111111, 999999);
        //     $salarySlipPath = "UserProfile/SalarySlips/SalarySlip{$number}.pdf";
        //     Storage::putFileAs('public', $salary_slip, $salarySlipPath);
        // }

        $bankStatementPath = NULL;
        if ($request->hasFile('bank_statement')) {
            if ($user && $user->bank_statement) {
                Storage::delete('public/' . $user->bank_statement);
            }

            $bank_statement = $request->file('bank_statement');
            $number = rand(1111111, 999999);
            $bankStatementPath = "UserProfile/BankStatements/BankStatement{$number}.pdf";
            Storage::putFileAs('public', $bank_statement, $bankStatementPath);
        }

        $data = $request->all();
        $data['id'] = $request->id;

        // if ($salarySlipPath) {
        //     $data['salary_slip'] = $salarySlipPath;
        // }
        if ($bankStatementPath) {
            $data['bank_statement'] = $bankStatementPath;
        }

        $response = $this->UserService->updateLoanLimitInfo($data);

        if ($response) {
           return redirect()->back()->with('success', 'Loan limit details updated successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateKYCInfo(Request $request)
    {
        Session::flash('kyc_info', true);
        $request->validate([
            'aadhaar_number' => 'required',
            'pan_card_number' => 'required',
            'selfie' => 'nullable|image',
            'aadhaar_image' => 'nullable|image',
            'aadhaar_name' => 'required',
            'aadhaar_dob' => 'required',
            'pan_name' => 'required'
        ], [
            'aadhaar_number.required' => 'The aadhaar number field is required.',
            'pan_card_number.required' => 'The pan number field is required.',
            'selfie.image' => 'The file must be an image.',
            'aadhaar_image.image' => 'The file must be an image.',
            'aadhaar_name.required' => 'The aadhaar name field is required.',
            'aadhaar_dob.required' => 'The aadhaar dob field is required.',
            'pan_name.required' => 'The pan name field is required.',
        ]);

        $user = $this->UserService->fetchUser($request->id);
        $userId = $user->id;

        $selfiePath = null;
        if ($request->hasFile('selfie')) {
            if ($user && $user->selfie) {
                Storage::delete('public/' . $user->selfie);
            }

            $selfie = $request->file('selfie');
            $number = rand(1111111, 999999);
            $selfiePath = "UserProfile/Selfies/Selfie{$number}.".$selfie->getClientOriginalExtension();
            Storage::putFileAs('public', $selfie, $selfiePath);
        }

        $aadhaarImagePath = null;
        if ($request->hasFile('aadhaar_image')) {
            if ($user && $user->aadhaar_image) {
                Storage::delete('public/' . $user->aadhaar_image);
            }

            $aadhaarImage = $request->file('aadhaar_image');
            $number = rand(1111111, 999999);
            $aadhaarImagePath = "AadhaarImages/{$userId}_{$number}.".$aadhaarImage->getClientOriginalExtension();
            Storage::putFileAs('public', $aadhaarImage, $aadhaarImagePath);
        }

        $data = $request->all();
        $data['id'] = $request->id;

        if ($selfiePath) {
            $data['salary_slip'] = $selfiePath;
        }

        if ($aadhaarImagePath) {
            $data['aadhaar_image'] = $aadhaarImagePath;
        }

        $response = $this->UserService->updateKYCInfo($data);
        if ($response) {
           return redirect()->back()->with('success', 'KYC details updated successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateBankInfo(Request $request)
    {
        Session::flash('bank_info', true);
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required'
        ], [
            'bank_name.required' => 'The bank name field is required.',
            'account_number.required' => 'The account number field is required.',
            'ifsc_code.required' => 'The IFSC code field is required.'
        ]);

        $data = $request->all();
        $data['id'] = $request->id;

        $response = $this->UserService->updateBankInfo($data);
        if ($response) {
           return redirect()->back()->with('success', 'Bank details updated successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
}
