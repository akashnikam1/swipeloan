<?php

namespace App\Http\Controllers;

use App\Models\LoanLimitRequest;
use App\Models\User;
use App\Services\LoanLimitRequestService;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class LoanLimitRequestController extends Controller
{
    protected $LoanLimitRequestService;

    public function __construct()
    {
        $this->LoanLimitRequestService = new LoanLimitRequestService();
    }

    public function getAllLoanLimitRequests(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->LoanLimitRequestService->fetchRecord($data);

            if ($request->has('from_date') && $request->has('to_date')) {
                $fromDate = $request->from_date;
                $toDate = Carbon::parse($request->to_date)->endOfDay();

                if ($fromDate && $toDate) {
                    $record = $record->whereBetween('created_at', [$fromDate, $toDate]);
                }
            }
            
            return DataTables::of($record)
                ->addColumn('action', function ($rec) {
                    $disabled = $rec->status == 0    ? 'disabled' : '';

                    return '<ul class="nk-tb-actions gx-1 my-n1">
                    <li class="me-n1">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-start">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="javascript:void(0);" class="edit-btn" data-id="' . $rec->id . '" data-user-id="' . $rec->user_id . '" '. $disabled . '><em class="icon ni ni-edit"></em><span>Update Loan Limit</span></a></li>
                                </ul>
                            </div> 
                        </div>
                    </li>
                </ul>';
            })->rawColumns(['action'])->make(true);
        }
        return view('loan_limit_requests.all');
    }

    public function updateCreditLimit(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'credit_limit' => 'required',
        ], [
            'credit_limit.required' => 'The credit limit field is required.'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('showCreditModal', true)
                             ->with('id', $request->id)
                             ->with('user_id', $request->user_id);
        }

        $id = $request->id;
        $userId = $request->user_id;
        $creditLimit = $request->credit_limit;

        if (!empty($id)) {
            $response1 = LoanLimitRequest::where('id', $id)->update([
                'credit_limit' => $creditLimit,
                'status' => 1
            ]);

            $response2 = User::where('id', $userId)->update([
                'credit_limit' => $creditLimit
            ]);
            
            if ($response1 && $response2 ) {
                $message = "Loan Limit updated successfully";
                return redirect()->back()->with('success', $message);
            }
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
}
