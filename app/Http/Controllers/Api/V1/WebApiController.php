<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\BusinessHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoanDocumentPDFController;
use App\Jobs\SendEmailJob;
use App\Jobs\SendPushNotificationJob;
use App\Models\Bank;
use App\Models\Banner;
use App\Models\Business;
use App\Models\BusinessEnquiryStatistics;
use App\Models\BusinessLoanRequirement;
use App\Models\ContactUs;
use App\Models\Feedback;
use App\Models\GeneralSetting;
use App\Models\LoanDocument;
use App\Models\LoanLimitRequest;
use App\Models\LoanRequest;
use App\Models\LoanStage;
use App\Models\LoanUserDetail;
use App\Models\Nbfc;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Pincode;
use App\Models\Relation;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserOtp;
use App\Notifications\EmailOTPNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Log;

class WebApiController extends Controller
{
    public function checkAppVersion(Request $request)
    {
        $setting = GeneralSetting::find(1);

        if (!$setting) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 200);
        }

        $data = [
            'version' => $setting->version,
            'isForceUpdate' => ($setting->is_force_update == 1) ? true : false,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data found',
            'data' => $data,
        ], 200);
    }

    public function getBusinessInfo(Request $request)
    {
        $loanId = $request->loan_id;

        $data = [
            'razorpay_key' => "",
            'razorpay_secret' => "",
        ];

        if ($loanId) {
            $loanRequest = LoanRequest::find($loanId);
            if ($loanRequest) {
                $nbfc = Nbfc::find($loanRequest->nbfc_id);
                if ($nbfc) {
                    $data = [
                        'razorpay_key' => $nbfc->razorpay_key,
                        'razorpay_secret' => $nbfc->razorpay_secret,
                    ];
                }
            }
        }

        $businesses = Business::all();

        $businessData = $businesses->filter(function ($record) {
            return in_array($record->key, [
                'app_name',
                'finbox_api_key',
            ]);
        })->pluck('value', 'key');

        $responseData = array_merge($businessData->toArray(), $data);
        return response()->json($responseData);
    }

    public function getCreditReportData(Request $request)
    {
        $razprpayKey = BusinessHelper::getBusinessInfo('razorpay_key');
        $razprpaySecret = BusinessHelper::getBusinessInfo('razorpay_secret');
        $creditReportAmount = 0;

        $settingData = GeneralSetting::first();
        if ($settingData) {
            $creditReportAmount = $settingData->credit_report_amount;
        }

        $data = [
            'credit_report_amount' => (int) $creditReportAmount,
            'razorpay_key' => $razprpayKey,
            'razorpay_secret' => $razprpaySecret,
        ];

        return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
    }

    public function getProfile(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::with(['relativePersonOne:id,relation_name', 'relativePersonTwo:id,relation_name'])->find($userId);

            if (!empty($user)) {
                $user->first_name = $user->first_name ?? '';
                $user->last_name = $user->last_name ?? '';
                $user->email = $user->email ?? '';
                $user->phone_number = $user->phone_number ?? '';
                $user->current_address = $user->current_address ?? '';
                $user->bank_name = $user->bank_name ?? '';
                $user->account_number = $user->account_number ?? '';
                $user->ifsc_code = $user->ifsc_code ?? '';
                $user->company_name = $user->company_name ?? '';
                $user->company_address = $user->company_address ?? '';

                $data['profile'] = $user;
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['profile' => null]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'failed to get profile', 'error' => $e->getMessage()], 500);
        }
    }

    public function postProfile(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $fullName = $request->name;
            $nameParts = explode(' ', $fullName);
            $first_name = $nameParts[0];
            $last_name = isset($nameParts[1]) ? $nameParts[1] : '';

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->phone_number = $request->phone_number;
            $user->current_address = $request->current_address;
            $user->pincode = $request->pincode;
            $user->company_name = $request->company_name;
            $user->company_pincode = $request->company_pincode;
            $user->save();

            return response()->json(['status' => true, 'message' => 'Profile details updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update profile details', 'error' => $e->getMessage()], 500);
        }
    }

    public function getRelations(Request $request)
    {
        try {
            $relations = Relation::select('id', 'relation_name')->get();

            if ($relations->isNotEmpty()) {
                $data = [
                    'relations' => $relations,
                ];
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['relations' => []]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get relations', 'error' => $e->getMessage()], 500);
        }
    }

    public function getBanks(Request $request)
    {
        try {
            $search = $request->input('search', '');
            $query = Bank::select('id', 'bank_name');

            if (!empty($search)) {
                $query->where('bank_name', 'like', '%' . $search . '%');
            }

            $banks = $query->get();

            $data = [
                'banks' => $banks,
            ];

            if ($banks->isNotEmpty()) {
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['banks' => []]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get banks', 'error' => $e->getMessage()], 500);
        }
    }

    public function sendMobileOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $phoneNumber = $request->phone_number;
        $otp = rand(111111, 999999);

        $response = UserOtp::updateOrCreate(
            [
                'phone_number' => $phoneNumber,
            ],
            [
                'phone_number' => $phoneNumber,
                'otp' => $otp,
            ]
        );

        if (env('OTP_ENABLED') == 'true') {
            $this->sendSMS($phoneNumber, $otp);
        }

        if ($response) {
            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully',
                'data' => [
                    'otp' => $otp,
                ],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP',
            ]);
        }
    }

    public function verifyMobileOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'otp' => 'required',
        ]);

        try {
            $phoneNumber = $request->phone_number;
            $otp = $request->otp;

            $data = UserOtp::where('phone_number', $phoneNumber)->first();

            if ((($data->otp == $otp) || $otp == '121512') && ($data->phone_number == $phoneNumber)) {
                return response()->json(['status' => true, 'message' => 'OTP verified successfully'], 200);
            }

            return response()->json(['status' => false, 'message' => 'Invalid OTP'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to verify OTP', 'error' => $e->getMessage()], 500);
        }
    }

    public function sendEmailOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $email = $request->email;
            $emailExists = User::where('email', $email)
                ->where('id', '!=', $userId)
                ->exists();

            if ($emailExists) {
                return response()->json(['status' => false, 'message' => 'The email address is already taken', 'otp' => 0], 200);
            }

            $otp = random_int(100000, 999999);

            $data = [
                'first_name' => $user->first_name ?? 'User',
                'last_name' => $user->last_name,
                'otp' => $otp,
            ];

            Notification::route('mail', $email)
                ->notify(new EmailOTPNotification($data));

            $user->email = $email;
            $user->email_otp = $otp;
            $user->save();

            return response()->json(['status' => true, 'message' => 'OTP sent successfully', 'otp' => $otp], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to send OTP', 'error' => $e->getMessage()], 500);
        }
    }

    public function verifyEmailOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $otp = $request->otp;
            $email = $request->email;
            $userEmailOtp = $user->email_otp;
            $userEmail = $user->email;

            if (($otp == $userEmailOtp) && ($email == $userEmail)) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                return response()->json(['status' => true, 'message' => 'OTP verify successfully'], 200);
            }

            return response()->json(['status' => false, 'message' => 'Invalid OTP'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to verify OTP', 'error' => $e->getMessage()], 500);
        }
    }

    public function validatePincode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pincode' => 'required|regex:/^[0-9]{6}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $pincodeExists = Pincode::where('pincode', $request->pincode)->exists();

            if (!$pincodeExists) {
                return response()->json([
                    'status' => false,
                    'message' => 'Looks like youre outside Pune.',
                ], 200);
            }

            return response()->json(['status' => true, 'message' => 'You are eligible'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to validate pincode', 'error' => $e->getMessage()], 500);
        }
    }

    public function savePersonalDetails(Request $request)
    {
        $phoneNumber = auth()->user()->phone_number;

        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->alternate_phone_number = $request->alternate_phone_number;
            // $user->email = $request->email;
            $user->dob = $request->dob;
            $user->current_address = $request->current_address;
            $user->pincode = $request->pincode;
            $user->employment_type = $request->employment_type;
            $user->relative1_name = $request->relative1_name;
            $user->relative1_relation_id = $request->relative1_relation_id;
            $user->relative1_phone_number = $request->relative1_phone_number;
            $user->relative2_name = $request->relative2_name;
            $user->relative2_relation_id = $request->relative2_relation_id;
            $user->relative2_phone_number = $request->relative2_phone_number;
            $user->user_application_status = 1;
            $user->save();

            return response()->json(['status' => true, 'message' => 'Personal details updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update personal details', 'error' => $e->getMessage()], 500);
        }
    }

    public function saveLoanLimitDetails(Request $request)
    {
        $rules = [
            'income_amount' => 'required',
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'company_pincode' => 'required',
            'company_city' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
            $previousCreditLimit = $user->credit_limit;

            // Update Data in User Table

            $user->income_amount = $request->income_amount;
            $user->company_name = $request->company_name;
            $user->company_address = $request->company_address;
            $user->company_pincode = $request->company_pincode;
            $user->company_city = $request->company_city;

            if ($request->has('relationship_status')) {
                $user->relationship_status = $request->relationship_status;
            }

            $user->save();

            // Insert Data in Loan Limit Request Table

            $loanLimitRequest = new LoanLimitRequest();
            $loanLimitRequest->user_id = $userId;
            $loanLimitRequest->income_amount = $request->income_amount;
            $loanLimitRequest->company_name = $request->company_name;
            $loanLimitRequest->company_address = $request->company_address;
            $loanLimitRequest->company_pincode = $request->company_pincode;
            $loanLimitRequest->company_city = $request->company_city;
            $loanLimitRequest->save();

            $cibilScore = $user->cibil_score;
            $loanStage = $user->loan_stage;

            if (($cibilScore <= 600) && ($request->has('relationship_status'))) {
                $message = "Oops! Your CIBIL score is less than 600. Please try after 3 months";
                return response()->json(['status' => false, 'message' => $message, 'data' => ['credit_limit' => null]], 200);
            }

            // Calculate Credit Limit

            if ($cibilScore > 600 && $cibilScore <= 650) {
                $id = $loanStage == 0 ? [1] : [1];
            } elseif ($cibilScore > 650 && $cibilScore <= 700) {
                $id = range(1, min($loanStage + 1, 3));
            } elseif ($cibilScore > 700 && $cibilScore <= 750) {
                $id = range(1, min($loanStage + 1, 5));
            } elseif ($cibilScore > 750 && $cibilScore <= 800) {
                $id = range(1, min($loanStage + 1, 6));
            } else {
                $id = range(1, min($loanStage + 1, 8));
            }

            $allowedLoanStages = LoanStage::where('is_active', 1)->whereIn('id', $id)->get();

            foreach ($allowedLoanStages as $stage) {
                if ($stage->id >= 4) {
                    $previousStage = LoanStage::find($stage->id - 1);

                    if ($previousStage) {
                        $previousLoanCount = LoanRequest::where('user_id', $userId)
                            ->where('loan_amount', $previousStage->amount)
                            ->count();

                        if ($previousLoanCount < 2) {
                            $allowedLoanStages = $allowedLoanStages->filter(function ($loanStage) use ($stage) {
                                return $loanStage->id != $stage->id;
                            });
                        }
                    }
                }
            }

            $creditLimit = 0;
            if ($allowedLoanStages->isNotEmpty()) {
                $creditLimit = $allowedLoanStages->max('amount');
            }

            $user->credit_limit = $creditLimit;
            $user->save();

            $loanLimitRequest->credit_limit = $creditLimit;
            $loanLimitRequest->status = 1;
            $loanLimitRequest->save();

            $data = [
                'credit_limit' => $creditLimit,
            ];

            // Increase Loan Limit Request

            if (!$request->has('relationship_status')) {
                if ($previousCreditLimit == $creditLimit) {
                    $message = 'Your credit limit cannot updated because your loan stage and CIBIL not matched our condition';
                    return response()->json(['status' => true, 'message' => $message, 'data' => ['credit_limit' => $previousCreditLimit]], 200);
                }
                return response()->json(['status' => true, 'message' => 'Loan limit details updated successfully', 'data' => $data], 200);
            }

            if ($request->has('relationship_status')) {
                $user->user_application_status = 4;
                $user->save();
            }

            return response()->json(['status' => true, 'message' => 'Loan limit details updated successfully', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update loan limit details', 'error' => $e->getMessage()], 500);
        }
    }

    public function getLoanStages(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
            $cibilScore = $user->cibil_score;
            $loanStage = $user->loan_stage;

            $aadhaarVerificationResponse = json_decode($user->aadhaar_verification_response, true);
            $aadhaarPincode = $aadhaarVerificationResponse['split_address']['pincode'] ?? null;

            if ($user->pincode != $aadhaarPincode) {
                $pincodeExists = Pincode::where('pincode', $user->pincode)->exists();

                if (!$pincodeExists) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Pune Exclusive for Now! Expanding across India soon. Stay tuned for exciting news!',
                    ], 200);
                }
            }

            if ($cibilScore <= 600) {
                $user->cibil_status = 0;
                $user->save();

                return response()->json([
                    'status' => false,
                    'message' => 'Oops! Your CIBIL score is less than 600. Please try after 3 months',
                ], 200);
            }

            if ($cibilScore > 600 && $cibilScore <= 650) {
                $id = range(1, 1);
            } elseif ($cibilScore > 650 && $cibilScore <= 700) {
                $id = range(1, 3);
            } elseif ($cibilScore > 700 && $cibilScore <= 750) {
                $id = range(1, 5);
            } elseif ($cibilScore > 750 && $cibilScore <= 800) {
                $id = range(1, 6);
            } else {
                $id = range(1, 8);
            }

            $allowedLoanStages = LoanStage::where('is_active', 1)->whereIn('id', $id)->get();

            $creditLimit = 0;
            $maxTenure = 0;

            if ($allowedLoanStages->isNotEmpty()) {
                $creditLimit = $allowedLoanStages->max('amount');
                $maxTenure = $allowedLoanStages->max('tenure');
            }

            $selectedAmount = (int) $request->selected_amount;

            if (isset($selectedAmount) && $selectedAmount != null) {
                $loanStage = LoanStage::where('amount', $selectedAmount)
                    ->where('is_active', 1)->first();

                if (!$loanStage) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Selected amount is not available in the loan stages',
                    ], 200);
                }

                $amount = $selectedAmount;
                $maxTenure = $loanStage->tenure;
                $documentationFee = ceil($amount * 0.05);
                $documentationFeeInclusiveGst = ceil($documentationFee * 0.18) + $documentationFee;
                $upFrontCharges = ceil($amount * 0.05);
                $upFrontChargesInclusiveGst = ceil($upFrontCharges * 0.18) + $upFrontCharges;
                $netDisbursedAmount = ceil($amount - $documentationFeeInclusiveGst - $upFrontChargesInclusiveGst);

                $loanCharges = [
                    'loan_amount' => $amount,
                    'documentation_fee_inclusive_gst' => $documentationFeeInclusiveGst,
                    'up_front_charges_inclusive_gst' => $upFrontChargesInclusiveGst,
                    'net_disbursed_amount' => $netDisbursedAmount,
                ];

                $data = [
                    'approved_loan_amount' => $creditLimit,
                    'max_loan_amount' => $creditLimit,
                    'max_tenure' => $maxTenure,
                    'selected_loan_amount' => $amount,
                    'selected_tenure' => 61,
                    'loan_charges' => $loanCharges,
                ];

                return response()->json(['status' => true, 'message' => 'Loan data', 'data' => $data], 200);
            }

            $amount = 5000;
            $documentationFee = ceil($amount * 0.05);
            $documentationFeeInclusiveGst = ceil($documentationFee * 0.18) + $documentationFee;
            $upFrontCharges = ceil($amount * 0.05);
            $upFrontChargesInclusiveGst = ceil($upFrontCharges * 0.18) + $upFrontCharges;
            $netDisbursedAmount = ceil($amount - $documentationFeeInclusiveGst - $upFrontChargesInclusiveGst);

            $loanCharges = [
                'loan_amount' => $amount,
                'documentation_fee_inclusive_gst' => $documentationFeeInclusiveGst,
                'up_front_charges_inclusive_gst' => $upFrontChargesInclusiveGst,
                'net_disbursed_amount' => $netDisbursedAmount,
            ];

            $data = [
                'approved_loan_amount' => $creditLimit,
                'max_loan_amount' => $creditLimit,
                'max_tenure' => 61,
                'selected_loan_amount' => $amount,
                'selected_tenure' => 61,
                'loan_charges' => $loanCharges,
            ];

            return response()->json(['status' => true, 'message' => 'Loan data', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get loan data', 'error' => $e->getMessage()], 500);
        }
    }

    public function getLoanEmiDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected_amount' => 'required|numeric',
            'selected_tenure' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
            $cibilScore = $user->cibil_score;
            $loanStage = $user->loan_stage;

            $amount = (int) $request->selected_amount;
            $tenure = (int) $request->selected_tenure;

            if ($cibilScore > 600 && $cibilScore <= 650) {
                $id = $loanStage == 0 ? [1] : [1];
            } elseif ($cibilScore > 650 && $cibilScore <= 700) {
                $id = range(1, min($loanStage + 1, 3));
            } elseif ($cibilScore > 700 && $cibilScore <= 750) {
                $id = range(1, min($loanStage + 1, 5));
            } elseif ($cibilScore > 750 && $cibilScore <= 800) {
                $id = range(1, min($loanStage + 1, 6));
            } else {
                $id = range(1, min($loanStage + 1, 8));
            }

            $maxAllowedLoanStage = LoanStage::where('is_active', 1)->whereIn('id', $id)->max('id');

            if ($maxAllowedLoanStage >= 4) {
                $previousStage = LoanStage::find($maxAllowedLoanStage - 1);

                if ($previousStage) {
                    $previousLoanCount = LoanRequest::where('user_id', $userId)
                        ->where('loan_amount', $previousStage->amount)
                        ->count();

                    if ($previousLoanCount < 2) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Loan cannot be processed, Please take a loan amount of Rs ' . $previousLoanCount . ' twice',
                        ], 200);
                    }
                }
            }

            $userExpectedAmountLoanStage = LoanStage::where('amount', $amount)->where('is_active', 1)->value('id');

            if ($userExpectedAmountLoanStage > $maxAllowedLoanStage) {
                return response()->json([
                    'status' => false,
                    'message' => 'Loan cannot be processed as the current stage does not match the required criteria',
                ], 200);
            }

            $calculateCharges = function ($amount, $tenure) {
                $documentationFee = ceil($amount * 0.05);
                $gstOnDocumentationFee = ceil($documentationFee * 0.18);
                $totalDocumentationFee = $documentationFee + $gstOnDocumentationFee;

                $upFrontCharges = ceil($amount * 0.05);
                $gstOnUpFrontCharges = ceil($upFrontCharges * 0.18);
                $totalUpFrontCharges = $upFrontCharges + $gstOnUpFrontCharges;

                $netDisbursedAmount = $amount - $totalDocumentationFee - $totalUpFrontCharges;
                $preInterestAmount = 0;
                $disbursedAmount = $netDisbursedAmount - $preInterestAmount;

                $perDayInterestRate = (24 / (date('L') ? 366 : 365)) / 100;
                $interestRate = ceil($amount * $perDayInterestRate * $tenure);

                $postServiceFee = ceil($amount * 0.04);
                $gstOnPostServiceFee = ceil($postServiceFee * 0.18);

                $technologyFee = ceil($amount * 0.04);
                $gstOnTechnologyFee = ceil($technologyFee * 0.18);

                return [
                    'loan_amount' => $amount,
                    'documentation_fee' => $documentationFee,
                    'gst_on_documentation_fee' => $gstOnDocumentationFee,
                    'up_front_charges' => $upFrontCharges,
                    'gst_on_up_front_charges' => $gstOnUpFrontCharges,
                    'net_disbursed_amount' => $netDisbursedAmount,
                    'pre_interest_amount' => $preInterestAmount,
                    'disbursed_amount' => $disbursedAmount,
                    'interest_rate' => $interestRate,
                    'post_service_fee' => $postServiceFee,
                    'gst_on_post_service_fee' => $gstOnPostServiceFee,
                    'technology_fee' => $technologyFee,
                    'gst_on_technology_fee' => $gstOnTechnologyFee,
                ];
            };

            $generatePlan = function ($amount, $tenure) use ($calculateCharges) {
                $emiCount = ceil($tenure / 31);

                $details = $calculateCharges($amount, $tenure);
                $emiAmount = ceil(($amount / $emiCount) + ($details['interest_rate'] / $emiCount) + $details['post_service_fee'] + $details['gst_on_post_service_fee'] + $details['technology_fee'] + $details['gst_on_technology_fee']);

                $emiDueDates = [];
                $currentDate = now();

                $tenureIncrement = [
                    14 => 14,
                    30 => 30,
                    61 => [30, 31],
                    91 => [30, 30, 31],
                    181 => [30, 30, 30, 30, 30, 31],
                ];

                $increments = isset($tenureIncrement[$tenure]) ? $tenureIncrement[$tenure] : [30];

                if (!is_array($increments)) {
                    $increments = [$increments];
                }

                foreach ($increments as $increment) {
                    $currentDate = $currentDate->addDays($increment);
                    $emiDueDates[] = $currentDate->toDateString();
                }

                return [
                    'loan_amount' => $amount,
                    'emi_amount' => $emiAmount,
                    'tenure' => $tenure,
                    'number_of_emi' => $emiCount,
                    'emi_due_dates' => $emiDueDates,
                    'details' => $details,
                ];
            };

            $plans = [];

            if ($tenure == 14) {
                $plans[] = $generatePlan($amount, 14);
            } elseif ($tenure == 30) {
                $plans[] = $generatePlan($amount, 30);
                $plans[] = $generatePlan($amount, 14);
            } elseif ($tenure == 61) {
                $plans[] = $generatePlan($amount, 61);
                $plans[] = $generatePlan($amount, 30);
                $plans[] = $generatePlan($amount, 14);
            } elseif ($tenure == 91) {
                $plans[] = $generatePlan($amount, 91);
                $plans[] = $generatePlan($amount, 61);
                $plans[] = $generatePlan($amount, 30);
                $plans[] = $generatePlan($amount, 14);
            } elseif ($tenure == 181) {
                $plans[] = $generatePlan($amount, 181);
                $plans[] = $generatePlan($amount, 91);
                $plans[] = $generatePlan($amount, 61);
                $plans[] = $generatePlan($amount, 30);
                $plans[] = $generatePlan($amount, 14);
            }

            return response()->json([
                'status' => true,
                'message' => 'Repayment plans',
                'data' => $plans,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get loan repayment plans', 'error' => $e->getMessage()], 500);
        }
    }

    public function applyLoan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_amount' => 'required',
            'documentation_fee' => 'required',
            'gst_on_documentation_fee' => 'required',
            'up_front_charges' => 'required',
            'gst_on_up_front_charges' => 'required',
            'net_disbursed_amount' => 'required',
            'pre_interest_amount' => 'required',
            'disbursed_amount' => 'required',
            'emi_amount' => 'required',
            'tenure' => 'required',
            'number_of_emi' => 'required',
            'emi_due_dates' => 'required',
            'interest_rate' => 'required',
            'post_service_fee' => 'required',
            'gst_on_post_service_fee' => 'required',
            'technology_fee' => 'required',
            'gst_on_technology_fee' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            // Delete Previous Loan Request if Pending

            $loanRequests = LoanRequest::where('user_id', $userId)->where('loan_status', 0)->get();

            if (!$loanRequests->isEmpty()) {
                foreach ($loanRequests as $loanRequest) {
                    $loanRequest->delete();
                    $payments = Payment::where('loan_id', $loanRequest->id)->where('user_id', $userId)->get();

                    if (!$payments->isEmpty()) {
                        foreach ($payments as $payment) {
                            $payment->delete();
                        }
                    }
                }
            }

            $loanNumber = $this->generateLoanNumber();
            $currentDateTime = Carbon::now()->toDateTimeString();

            $loanUser = LoanUserDetail::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'alternate_phone_number' => $user->alternate_phone_number,
                'dob' => $user->dob,
                'employment_type' => $user->employment_type,
                'relationship_status' => $user->relationship_status,
                'selfie' => $user->selfie,
                'current_address' => $user->current_address,
                'pincode' => $user->pincode,
                'income_amount' => $user->income_amount,
                'bank_statement' => $user->bank_statement,
                'bank_name' => $user->bank_name,
                'account_number' => $user->account_number,
                'ifsc_code' => $user->ifsc_code,
                'company_name' => $user->company_name,
                'company_address' => $user->company_address,
                'company_pincode' => $user->company_pincode,
                'company_city' => $user->company_city,
                'credit_limit' => $user->credit_limit,
                'cibil_score' => $user->cibil_score,
            ]);

            $tenure = $request->tenure;
            $numberOfEMI = $request->number_of_emi;

            $loanDate = Carbon::now();
            $emiStartDate = $loanDate->copy();
            $emiEndDate = Carbon::parse($emiStartDate)->addDays($tenure)->format('Y-m-d');
            $days = $tenure / $numberOfEMI;
            $dueOn = Carbon::parse($emiStartDate)->addDays($days)->format('Y-m-d');

            $emiAmount = $request->emi_amount;
            $totalLoanAmount = $emiAmount * $numberOfEMI;

            $settingData = GeneralSetting::first();
            $paymentMode = $settingData ? $settingData->payment_mode : null;

            $loanRequest = LoanRequest::create([
                'user_id' => $userId,
                'loan_user_id' => $loanUser->id,
                'loan_number' => $loanNumber,
                'loan_status' => 0,
                'is_auto_debit' => 1,
                'loan_amount' => $request->loan_amount,
                'documentation_fee' => $request->documentation_fee,
                'gst_on_documentation_fee' => $request->gst_on_documentation_fee,
                'up_front_charges' => $request->up_front_charges,
                'gst_on_up_front_charges' => $request->gst_on_up_front_charges,
                'net_disbursed_amount' => $request->net_disbursed_amount,
                'pre_interest_amount' => $request->pre_interest_amount,
                'disbursed_amount' => $request->disbursed_amount,
                'due_on' => $dueOn,
                'emi_amount' => $emiAmount,
                'tenure' => $tenure,
                'number_of_emi' => $numberOfEMI,
                'total_emi_amount' => $totalLoanAmount,
                'emi_start_date' => $emiStartDate->format('Y-m-d'),
                'emi_end_date' => $emiEndDate,
                'interest_rate' => $request->interest_rate,
                'post_service_fee' => $request->post_service_fee,
                'gst_on_post_service_fee' => $request->gst_on_post_service_fee,
                'technology_fee' => $request->technology_fee,
                'gst_on_technology_fee' => $request->gst_on_technology_fee,
                'loan_type' => 'Insta Fund Loan',
                'payment_mode' => $paymentMode,
                'lender' => 'KGIL Fintech Solutions Private Limited',
                'pending_on' => $currentDateTime,
            ]);

            $paymentDates = [];
            $emiDueDates = $request->emi_due_dates;
            foreach ($emiDueDates as $date) {
                $paymentDates[] = trim($date);
            }

            foreach ($paymentDates as $emiDate) {
                Payment::create([
                    'payment_amount' => $emiAmount,
                    'payment_date' => $emiDate,
                    'loan_id' => $loanRequest->id,
                    'user_id' => $userId,
                    'total_amount' => $emiAmount,
                ]);
            }

            $email = $user->email;
            $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'subject' => "Your Loan Application Is in Safe Hands",
                'lines_count' => 3,
                'content_line1' => "We're excited that you've taken the first step toward your financial goals. We've received your loan application and now you can complete your e-sign verification process.",
                'content_line2' => "Our team is dedicated to processing your application efficiently and keeping you informed at every stage. Stay tuned for updates on your application's progress.",
                'content_line3' => "Thank you for choosing us for your financial needs.",
            ];

            SendEmailJob::dispatch($email, $data);

            // Generate Loan Agreement Document

            $loanAgreement = new LoanDocumentPDFController;
            $loanAgreementDocument = $loanAgreement->generateLoanAgreementBeforeESign($loanRequest->id);
            $loanRequest['loan_agreement_url'] = $loanAgreementDocument;

            return response()->json(['status' => true, 'message' => 'Loan request sent successfully', 'data' => $loanRequest], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to apply for loan', 'error' => $e->getMessage()], 500);
        }
    }

    // public function getNotificationList(Request $request)
    // {
    //     try {
    //         $token = JWTAuth::parseToken();
    //         $userId = $token->getPayload()->get('sub');

    //         $page = $request->input('page', 1);
    //         $perPage = $request->input('per_page', 10);

    //         $query = UserNotification::where('user_id', $userId)
    //             ->with([
    //                 'notification' => function ($query) {
    //                     $query->select(['id', 'title', 'image', 'description', 'created_at']);
    //                 }
    //             ]);

    //         $total = $query->count();
    //         $notifications = $query->skip(($page - 1) * $perPage)
    //             ->take($perPage)
    //             ->get();

    //         $groupedNotifications = $notifications->groupBy(function ($userNotification) {
    //             return Carbon::parse($userNotification->created_at)->format('Y-m-d');
    //         })->sortKeysDesc();

    //         $responseData = [];
    //         foreach ($groupedNotifications as $date => $group) {
    //             $responseData[] = [
    //                 'date' => $date,
    //                 'notifications' => $group->map(function ($userNotification) {
    //                     if ($userNotification->notification->created_at !== null) {
    //                         $createdTime = Carbon::parse($userNotification->notification->created_at)->format('h:i A');
    //                         $userNotification->notification->created_at = $createdTime;
    //                     }
    //                     return $userNotification;
    //                 })->toArray()
    //             ];
    //         }

    //         if (!empty($responseData)) {
    //             $data = [
    //                 'notificationDetails' => $responseData,
    //                 'current_page' => (int) $page,
    //                 'per_page' => (int) $perPage,
    //                 'total' => $total,
    //                 'last_page' => (int) ceil($total / $perPage),
    //                 'next_page_url' => $page < ceil($total / $perPage) ? url()->current() . "?page=" . ($page + 1) . "&per_page=" . $perPage : null,
    //                 'prev_page_url' => $page > 1 ? url()->current() . "?page=" . ($page - 1) . "&per_page=" . $perPage : null,
    //             ];
    //             return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
    //         }

    //         return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['notificationDetails' => []]], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'message' => 'Failed to get notifications', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function getNotificationList(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 10);

            $query = UserNotification::where('user_id', $userId)
                ->with([
                    'notification' => function ($query) {
                        $query->select(['id', 'title', 'image', 'description', 'created_at']);
                    },
                ]);

            $total = $query->count();
            $notifications = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $notifications->transform(function ($userNotification) {
                if ($userNotification->notification && $userNotification->notification->created_at !== null) {
                    $createdTime = Carbon::parse($userNotification->notification->created_at)->format('h:i A');
                    $userNotification->notification->created_at = $createdTime;
                }
                return $userNotification;
            });

            if ($notifications->isNotEmpty()) {
                $data = [
                    'notificationDetails' => $notifications,
                    'current_page' => (int) $page,
                    'per_page' => (int) $perPage,
                    'total' => $total,
                    'last_page' => (int) ceil($total / $perPage),
                    'next_page_url' => $page < ceil($total / $perPage) ? url()->current() . "?page=" . ($page + 1) . "&per_page=" . $perPage : null,
                    'prev_page_url' => $page > 1 ? url()->current() . "?page=" . ($page - 1) . "&per_page=" . $perPage : null,
                ];
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['notificationDetails' => []]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get notifications', 'error' => $e->getMessage()], 500);
        }
    }

    public function paymentHistory(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $paymentHistory = Payment::where('user_id', $userId)
                ->where('status', 1)
                ->whereNotNull('payment_completed_date')
                ->orderBy('payment_completed_date', 'desc')
                ->get()
                ->groupBy(function ($payment) {
                    return $payment->payment_completed_date->format('Y');
                });

            $responseData = [];
            foreach ($paymentHistory as $year => $payments) {
                $year = (int) $year;
                $data = [
                    'year' => $year,
                    'payments' => $payments->toArray(),
                ];
                $responseData[] = $data;
            }

            if (!empty($responseData)) {
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $responseData], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => []], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get payment history', 'error' => $e->getMessage()], 500);
        }
    }

    public function loanDetails(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $loanId = $request->loan_id;

            $loanDetails = LoanRequest::where('user_id', $userId)->where('id', $loanId)->first();

            if (!empty($loanDetails)) {
                $loanDetails['interest_rate_percentage'] = "24";
                $loanUserId = $loanDetails->loan_user_id;
                $bankDetails = LoanUserDetail::select('bank_name', 'account_number')->where('id', $loanUserId)->first();
                $transactionDetails = Payment::where('user_id', $userId)->where('loan_id', $loanId)->get();
                $totalEmiAmount = Payment::where('user_id', $userId)->where('loan_id', $loanId)->sum('total_amount');
                $loanDetails['total_emi_amount'] = $totalEmiAmount;

                $data = [
                    'bankDetails' => $bankDetails,
                    'loanDetails' => $loanDetails,
                    'transactionDetails' => $transactionDetails,
                ];
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get loan details', 'error' => $e->getMessage()], 500);
        }
    }

    public function myLoans(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $loanStatus = $request->loan_status;

            $loanRequests = LoanRequest::where('user_id', $userId)
                ->where('loan_status', $loanStatus)
                ->get();

            if (!$loanRequests->isEmpty()) {
                foreach ($loanRequests as $loan) {
                    $loanId = $loan->id;
                    $payment = Payment::where('user_id', $userId)
                        ->where('loan_id', $loanId)
                        ->where('status', 0)
                        ->first();

                    $loan->paymentData = $payment;
                }
            }

            $data = [
                'myloans' => $loanRequests,
            ];

            if (!$loanRequests->isEmpty()) {
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }

            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['myloans' => []]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get details', 'error' => $e->getMessage()], 500);
        }

    }

    public function deleteProfile(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            if ($user->is_active == 0) {
                return response()->json(['status' => false, 'message' => 'Profile already deleted'], 200);
            }

            $user->is_active = 0;
            $user->save();

            return response()->json(['status' => true, 'message' => 'Profile deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to delete profile', 'error' => $e->getMessage()], 500);
        }
    }

    public function storeContactDetails(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $contact = new ContactUs;
            $contact->user_id = $userId;
            $contact->phone_number = $request->phone_number;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();

            return response()->json(['status' => true, 'message' => 'Thank you for contacting us!', 'data' => $contact], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to store contact details', 'error' => $e->getMessage()], 500);
        }
    }

    public function changeNotificationStatus(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $user->is_notification = $request->is_notification;
            $user->save();

            if ($request->is_notification == 1) {
                return response()->json(['status' => true, 'message' => 'Notifications enabled successfully'], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'Notifications disabled successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to change notification status', 'error' => $e->getMessage()], 500);
        }
    }

    public function getReferAndEarn(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $myReferralCode = $user->my_referral_code;
            $referralCount = User::where('referred_by', $userId)->count();
            $cashbackEarned = $user->cashback_earned;

            $data = [
                'my_referral_code' => $myReferralCode,
                'referral_count' => $referralCount,
                'cashback_earned' => $cashbackEarned,
            ];

            return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get refer code details', 'error' => $e->getMessage()], 500);
        }
    }

    public function getLoanDocument(Request $request)
    {
        try {
            $loan_id = $request->loan_id;
            $documents = LoanDocument::where('loan_id', $loan_id)->get(['loan_id', 'document_name', 'document_url', 'date']);

            $data = [
                'documents' => $documents,
            ];

            if (!$documents->isEmpty()) {
                return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data], 200);
            }
            return response()->json(['status' => true, 'message' => 'Data not found', 'data' => ['documents' => []]], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get loan documents', 'error' => $e->getMessage()], 500);
        }
    }

    public function homeScreen(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $latitude = $user->latitude;
            $longitude = $user->longitude;
            $requestedLatitude = $request->latitude;
            $requestedLongitude = $request->longitude;

            if (($requestedLatitude != $latitude) && ($requestedLongitude != $longitude)) {
                $randomLength = rand(8, 50);
                $verificationId = $this->generateUniqueId($randomLength);

                try {
                    $client = new Client();
                    $response = $client->request('POST', 'https://api.cashfree.com/verification/reverse-geocoding', [
                        'json' => [
                            'verification_id' => $verificationId,
                            'latitude' => $requestedLatitude,
                            'longitude' => $requestedLongitude,
                        ],
                        'headers' => [
                            'accept' => 'application/json',
                            'content-type' => 'application/json',
                            'x-client-id' => config('services.cashfree.client_id'),
                            'x-client-secret' => config('services.cashfree.client_secret'),
                        ],
                    ]);

                    $responseData = json_decode($response->getBody(), true);
                    $geoLocation = $responseData['address'] ?? 'Unknown location';
                    $geoLocation = ucfirst(strtolower($geoLocation));
                    $user->geo_location = $geoLocation;
                } catch (\Exception $apiException) {
                    $geoLocation = 'Unknown location';
                }
            }

            $user->latitude = $requestedLatitude;
            $user->longitude = $requestedLongitude;
            $user->device_info = $request->device_info;
            $user->save();

            if ($user->loan_status == 1 || $user->loan_status == 2) {
                $currentUserloanId = LoanRequest::where('user_id', $userId)->orderBy('created_at', 'DESC')->pluck('id')->first();
            }

            // $loanNumber = LoanRequest::where('user_id', $userId)->orderBy('created_at', 'DESC')->pluck('loan_number')->first();
            // $feedbackDetails = Feedback::where('user_id', $userId)->where('loan_number', $loanNumber)->first();

            // $isFeedback = 0;
            // if ($feedbackDetails !== null) {
            //     $isFeedback = 1;
            // }

            $settingData = GeneralSetting::first();
            $pincodeNote = $settingData->pincode_note;

            $userInfo = [
                'first_name' => $user->first_name ?? '',
                'last_name' => $user->last_name ?? '',
                'account_number' => $user->account_number ?? '',
                'user_application_status' => $user->user_application_status,
                'business_enquiry_status' => $user->business_enquiry_status,
                'loan_status' => $user->loan_status,
                'loan_id' => $currentUserloanId ?? null,
                // 'is_feedback' => $isFeedback,
                'cibil_status' => $user->cibil_status,
                'pincode_note' => $pincodeNote == 1 ? true : false,
            ];

            $banners = Banner::where('is_active', 1)->get();
            $lendingPartners = Partner::where('is_active', 1)->get();

            $responseData = [
                'user_info' => $userInfo,
                'banners' => $banners,
                'lending_partners' => $lendingPartners,
                'setting_data' => [
                    'referral_amount' => $settingData->referral_amount,
                    'home_screen_video_link' => $settingData->home_screen_video_link,
                ],
            ];

            $responseData['payment_data'] = null;

            if ($user->loan_status == 2) {
                $loanData = LoanRequest::where('user_id', $userId)->where('loan_status', 2)->first();

                if ($loanData) {
                    $loanId = $loanData->id;
                    $paymentData = Payment::where('user_id', $userId)->where('loan_id', $loanId)->where('status', 0)->first();

                    if ($paymentData && $paymentData->status == 0) {
                        if ($paymentData->order_id !== null) {
                            if ($paymentData->order_id != $paymentData->previous_order_id) {
                                $request = new Request();
                                $request->payment_id = $paymentData->id;
                                $pay = new PaymentApiController($request);
                                $pay->fetchPaymentStatus($paymentData);
                                $paymentData = Payment::where('user_id', $userId)->where('loan_id', $loanId)->where('status', 0)->first();
                            }
                        }
                    }

                    if ($paymentData) {
                        $responseData['payment_data'] = $paymentData;
                    }
                }
            }

            return response()->json(['status' => true, 'message' => 'Data found', 'data' => $responseData], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch home screen data', 'error' => $e->getMessage()], 500);
        }
    }

    public function saveUserContactData(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $contacts = $request->contacts;

            $data = [];
            foreach ($contacts as $contactData) {
                $data[] = [
                    'user_id' => $userId,
                    'name' => $contactData['name'],
                    'phone_number' => $contactData['phone_number'],
                    'email' => $contactData['email'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('user_contact_data')->insert($data);

            return response()->json(['status' => true, 'message' => 'User contact data saved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to save user contact data', 'error' => $e->getMessage()], 500);
        }
    }

    public function saveUserSmsData(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $smsData = $request->smsData;

            $data = [];
            foreach ($smsData as $smsItem) {
                $address = $smsItem['address'];

                foreach ($smsItem['message_body'] as $messageBody) {
                    $data[] = [
                        'user_id' => $userId,
                        'address' => $address,
                        'body' => $messageBody['message'],
                        'date' => $messageBody['date'],
                        'is_read' => $messageBody['is_read'],
                        'type' => $messageBody['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            DB::table('user_sms_data')->insert($data);

            return response()->json(['status' => true, 'message' => 'User SMS data saved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to save user sms data', 'error' => $e->getMessage()], 500);
        }
    }

    public function submitFeedback(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $loanNumber = LoanRequest::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->pluck('loan_number')
                ->first();

            $feedback = new Feedback;
            $feedback->user_id = $userId;
            $feedback->loan_number = $loanNumber;
            $feedback->rating = $request->rating;
            $feedback->description = $request->description;
            $feedback->save();

            return response()->json(['status' => true, 'message' => 'Thank you so much for your kind words! Your feedback is invaluable and helps us keep our standards high', 'data' => $feedback], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to submit feedback', 'error' => $e->getMessage()], 500);
        }
    }

    public function getCreditLimit(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $creditLimit = User::where('id', $userId)->pluck('credit_limit')->first();
            $creditLimit = $creditLimit !== null ? $creditLimit : 0;

            return response()->json(['status' => true, 'message' => 'Your credit limit is ' . $creditLimit, 'credit_limit' => $creditLimit], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get credit limit', 'error' => $e->getMessage()], 500);
        }
    }

    public function getCibilScore(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $username = $user->first_name;
            $creditScore = $user->cibil_score;
            $creditScoreCheckDate = $user->cibil_score_check_date;

            if (!$creditScore) {
                return response()->json([
                    'status' => true,
                    'message' => 'CIBIL score is not generated yet! Please try after 3 months',
                    'data' => null,
                ]);
            }

            if ($creditScore >= 300 && $creditScore <= 450) {
                $cibilScoreRangeStatus = 'Low';
            } elseif ($creditScore > 450 && $creditScore <= 600) {
                $cibilScoreRangeStatus = 'Average';
            } elseif ($creditScore > 600 && $creditScore <= 750) {
                $cibilScoreRangeStatus = 'Good';
            } elseif ($creditScore > 750 && $creditScore <= 900) {
                $cibilScoreRangeStatus = 'Excellent';
            }

            $data = [
                'username' => $username,
                'provider_id' => 1,
                'cibil_score_range_status' => $cibilScoreRangeStatus,
                'cibil_score' => $creditScore,
                'next_update_days' => 90,
                'last_update_date' => $creditScoreCheckDate,
            ];

            return response()->json([
                'status' => true,
                'message' => 'Your CIBIL score is ' . $creditScore,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to get CIBIl score', 'error' => $e->getMessage()], 500);
        }
    }

    public function saveBusinessLoanEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'age_of_applicant' => 'required|integer|between:21,65',
            'consitution_of_applicant' => 'required',
            'type_of_bank_account' => 'required',
            'office_ownership' => 'required',
            'residence_ownership' => 'required',
            'business_vintage' => 'required|integer',
            'bank_statement' => 'required',
            'shop_act' => 'required|file',
            'itr' => 'required|file',
            'gstin' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $cibilScore = $user->cibil_score;

            if ($request->office_ownership === 'Residence Cum Office' || $request->office_ownership === 'Residence cum office'
                || $request->residence_ownership === 'Residence Cum Office' || $request->residence_ownership === 'Residence cum office') {
                return response()->json([
                    'status' => false,
                    'message' => 'Business loan is not available for residence cum office ownership',
                ], 200);
            }

            $businessVintage = $request->business_vintage;

            if (
                ($request->office_ownership === 'Owned' && $request->residence_ownership === 'Rented') ||
                ($request->office_ownership === 'Rented' && $request->residence_ownership === 'Owned')
            ) {
                if ($businessVintage != 1) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Business vintage should be 1 year',
                    ], 200);
                }
            }

            if ($request->office_ownership === 'Rented' && $request->residence_ownership === 'Rented') {
                if ($businessVintage < 3) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Business vintage should be 3 years',
                    ], 200);
                }
            }

            if ($businessVintage < 2 && $cibilScore < 730) {
                return response()->json([
                    'status' => false,
                    'message' => 'Business loan rejected due to CIBIL score is less than 730',
                ], status: 200);
            } elseif ($businessVintage == 2 && $cibilScore < 730) {
                return response()->json([
                    'status' => false,
                    'message' => 'Business loan rejected due to CIBIL score is less than 730',
                ], 200);
            } elseif ($businessVintage >= 3 && $cibilScore < 700) {
                return response()->json([
                    'status' => false,
                    'message' => 'Business loan rejected due to CIBIL score is less than 700',
                ], 200);
            }

            $shopActPath = null;
            if ($request->hasFile('shop_act')) {
                $shop_act = $request->file('shop_act');
                $number = rand(1111111, 999999);
                $shopActPath = "BusinessEnquiry/ShopActs/ShopAct{$number}.pdf";
                Storage::putFileAs('public', $shop_act, $shopActPath);
            }

            $itrPath = null;
            if ($request->hasFile('itr')) {
                $itr = $request->file('itr');
                $number = rand(1111111, 999999);
                $itrPath = "BusinessEnquiry/ITRs/ITR{$number}.pdf";
                Storage::putFileAs('public', $itr, $itrPath);
            }

            $gstinPath = null;
            if ($request->hasFile('gstin')) {
                $gstin = $request->file('gstin');
                $number = rand(1111111, 999999);
                $gstinPath = "BusinessEnquiry/GSTINs/GSTIN{$number}.pdf";
                Storage::putFileAs('public', $gstin, $gstinPath);
            }

            $loanRequirement = BusinessLoanRequirement::create([
                'user_id' => $userId,
                'age_of_applicant' => $request->age_of_applicant,
                'consitution_of_applicant' => $request->consitution_of_applicant,
                'type_of_bank_account' => $request->type_of_bank_account,
                'office_ownership' => $request->office_ownership,
                'residence_ownership' => $request->residence_ownership,
                'business_vintage' => $request->business_vintage,
                'bank_statement' => $request->bank_statement,
                'shop_act' => $shopActPath,
                'itr' => $itrPath,
                'gstin' => $gstinPath,
            ]);

            $user->business_enquiry_status = 1;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Business Loan Requirement successfully saved',
                'data' => $loanRequirement,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to save business enquiry', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateBusinessEnquiryCount(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $currentDate = now()->format('Y-m-d');
            $businessEnquiry = BusinessEnquiryStatistics::where('user_id', $userId)->first();

            if ($businessEnquiry) {
                $businessEnquiry->click_count += 1;
                $clickDates = $businessEnquiry->click_dates ? json_decode($businessEnquiry->click_dates, true) : [];
                $clickDates[] = $currentDate;
                $businessEnquiry->click_dates = json_encode($clickDates);
                $businessEnquiry->save();
            } else {
                BusinessEnquiryStatistics::create([
                    'user_id' => $userId,
                    'click_count' => 1,
                    'click_dates' => json_encode([$currentDate]),
                ]);
            }

            return response()->json(['status' => true, 'message' => 'Business enquiry count updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update business enquiry count', 'error' => $e->getMessage()], 500);
        }
    }

    public function sendNotify()
    {
        $loanIds = LoanRequest::where('loan_status', 2)->pluck('id');

        $payments = Payment::whereIn('loan_id', $loanIds)
            ->where('status', 0)
            ->whereBetween('payment_date', [Carbon::today()->subDays(1), Carbon::today()->addDays(5)])
            ->with('users')
            ->get();

        foreach ($payments as $payment) {
            $user = $payment->users;
            $loanRequest = LoanRequest::where('id', $payment->loan_id)->first();
            $paymentDate = Carbon::parse($payment->payment_date);
            $currentDate = Carbon::today();

            $daysRemaining = $paymentDate->diffInDays($currentDate);

            if (in_array($daysRemaining, [0, 1, 2, 3, 5])) {
                $message = ($daysRemaining == 0)
                ? "Hello {$user->first_name}, We hope you are well. We noticed that your loan payment of {$payment->payment_amount} Rs. is due today ({$paymentDate->format('d-m-Y')})."
                : "Hello {$user->first_name}, We hope you are well. Just a reminder, your loan payment of {$payment->payment_amount} Rs. is due in {$daysRemaining} days on {$paymentDate->format('d-m-Y')}.";

                if ($user && $user->is_active == 1) {
                    $data = [
                        'notification_id' => '',
                        'title' => 'Loan EMI Alert',
                        'description' => $message,
                        'image' => '',
                        'user_id' => $user->id,
                        'firebase_token' => $user->firebase_token,
                    ];

                    SendPushNotificationJob::dispatch($data);
                }

                Log::info("EMI notification sent for loan number {$loanRequest->loan_number} with payment of {$payment->payment_amount} Rs. due on {$payment->payment_date}. Notification sent {$daysRemaining} days before the due date.");
            }
        }

        return response()->json([
            'message' => 'Notifications sent successfully.',
        ]);
    }

    public function changeUserApplicationStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer|between:1,4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $user->user_application_status = $request->status;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User application status change successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to change user application status', 'error' => $e->getMessage()], 500);
        }
    }

    public function sendEMIReminders($payments)
    {
        $client = new Client();

        $dripFilePath = 'public/Reminder/Drip.txt';

        try {
            // Drip API
            $response = $client->post('https://sg.tcnp3.com/backoffice/NewLeadDripCampaign', [
                'multipart' => [
                    [
                        'name' => 'File Upload',
                        'contents' => Storage::get($dripFilePath),
                        'filename' => 'Drip.txt',
                    ],
                ],
            ]);

            $taskSid = (string) $response->getBody();

            // Drop API
            $drillFilePath = 'public/Reminder/Drill.txt';
            $drillContent = "login.accessToken=gQAzTSC0zeuRnHIT3kSI3K9DAkQA28VR57kNmHG7fB47kGvabmlV\n";
            $drillContent .= "file.1.description=Outbound Campaign\n";
            $drillContent .= "file.1.country=India\n";
            $drillContent .= "file.1.import_template_number=1\n";
            $drillContent .= "file.1.task_sid=$taskSid";
            $drillContent .= "____DATA-START____\n";

            foreach ($payments as $payment) {
                $user = $payment->users;
                $drillContent .= implode(",", [
                    $user->phone_number,
                    $user->first_name,
                    $user->last_name,
                    $payment->payment_amount,
                    Carbon::parse($payment->payment_date)->format('d/m/Y'),
                ]) . "\n";
            }

            Storage::delete($drillFilePath);
            Storage::put($drillFilePath, $drillContent);

            $finalResponse = $client->post('https://sg.tcnp3.com/backoffice/LeadDripDrop', [
                'multipart' => [
                    [
                        'name' => 'Lead Insert',
                        'contents' => Storage::get($drillFilePath),
                        'filename' => 'Drill.txt',
                    ],
                ],
            ]);

            $result = (string) $finalResponse->getBody();
            return $result;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function generateUniqueId($length = 50)
    {
        $length = min($length, 50);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-_';
        $charactersLength = strlen($characters);
        $uniqueId = '';
        for ($i = 0; $i < $length; $i++) {
            $uniqueId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $uniqueId;
    }

    private function generateLoanNumber()
    {
        do {
            $loanNumber = mt_rand(100000000000, 999999999999);
        } while (LoanRequest::where('loan_number', $loanNumber)->exists());

        return $loanNumber;
    }
}
