<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\LoanDocument;
use App\Models\LoanRequest;
use App\Models\Nbfc;
use App\Models\Relation;
use App\Models\User;
use App\Models\Payment;
use App\Services\LoanRequestService;
use App\Models\ENachTransaction;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\PaymentApiController;

class LoanRequestController extends Controller
{
    protected $LoanRequestService;

    public function __construct()
    {
        $this->LoanRequestService = new LoanRequestService();
    }

    public function getAllLoanRequests(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->LoanRequestService->fetchRecord($data);

            if ($request->has('from_date') && $request->has('to_date')) {
                $fromDate = $request->from_date;
                $toDate = Carbon::parse($request->to_date)->endOfDay();

                if ($fromDate && $toDate) {
                    $record = $record->whereBetween('created_at', [$fromDate, $toDate]);
                }
            }

            if ($request->has('loan_status') && $request->loan_status != "null") {
                $loanStatus = $request->loan_status;
                $record = $record->where('loan_status', $loanStatus);
            }

            return DataTables::of($record)
            ->editColumn('disbursed_date', function ($record) {
                if ($record->disbursed_date) {
                    return Carbon::parse($record->disbursed_date)->format('d-m-Y');
                } else {
                    return "NA";
                }
            })->make(true);
        }
        return view('loan_requests.all');
    }

    public function getAllLoanRequestDetails(Request $request)
    {
        $id = $request->id;
        $data = $this->LoanRequestService->fetch($request->id);
        $loanDocuments = LoanDocument::where('loan_id', $id)->get();
        $relations = Relation::all();

        $payments = Payment::where('loan_id', $id)->get();
        foreach ($payments as $payment) {
            $payment->enachTransactions = ENachTransaction::where('payment_id', $payment->id)->get();
        }
    
        if ($request->ajax()) {
            return DataTables::of($loanDocuments)->make(true);
        }

        return view('loan_requests.loan_details', compact('data', 'relations', 'payments'));
    }

    public function declinedLoanRequest(Request $request)
    {
        $id = $request->id;
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        if (!empty($id)) {
            $loanData = LoanRequest::where('id', $id)->first();

            $user = User::where('id', $loanData->user_id)->first();
            $user->loan_status = 0;
            $user->save();

            $data['declined_on'] = $currentDateTime;
            $data['declined_reason'] = $request->declined_reason;
            $data['loan_status'] = 4;

            $response = LoanRequest::where('id', $id)->update($data);

            $email = $user->email;
            $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'subject' => "Update on Your Loan Application",
                'lines_count' => 3,
                'content_line1' => "We appreciate your interest in securing a loan with us. After careful consideration, we regret to inform you that your loan application has not been approved at this time.",
                'content_line2' => "We understand that this news might be disappointing, and we want to assure you that our decision is based on a thorough evaluation. If you have questions or would like to explore alternative options, our team is here to help.",
                'content_line3' => "Thank you for choosing us for your financial needs.",
            ];

            SendEmailJob::dispatch($email, $data);

            if ($response) {
                $message = "Declined status change successfully";
                return redirect()->back()->with('success', $message);
            }
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
    
  	public function disburseLoanAmount(Request $request)
    {
        $id = $request->id;
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        $currentDate = Carbon::now()->format('Y-m-d');

        if (!empty($id)) {
            $loanData = LoanRequest::where('id', $id)->first();
            $user = User::where('id', $loanData->user_id)->first();
            $disbursedAmount = $loanData->disbursed_amount;

            $nbfcRecords = Nbfc::where('is_active', 1)->get();

            if ($nbfcRecords->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No NBFC records found.',
                ]);
            }
    
            $validNbfc = null;
            $remainingNbfcRecords = $nbfcRecords->toArray();

            while (count($remainingNbfcRecords) > 0) {
                $randomIndex = array_rand($remainingNbfcRecords);
                $randomNbfc = $remainingNbfcRecords[$randomIndex];

                if ($randomNbfc['payment_limit'] >= $disbursedAmount) {
                    $validNbfc = $randomNbfc;
                    break; 
                }

                unset($remainingNbfcRecords[$randomIndex]);
            }

            if (!$validNbfc) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient funds in all NBFC records.',
                ]);
            }

            // Razorpay Payout

            $request = new Request();
            $request->nbfc_id = $validNbfc['id'];

            $payment = new PaymentApiController($request);
            $response = $payment->disburseLoanAmount($user, $disbursedAmount);
            $responseData = $response->getData();
            $responseStatus = $responseData->status;
            $responseMessage = $responseData->message;

            if ($responseStatus === true) {
                $user->loan_status = 2;
                $user->save();

                $data = [
                    'disbursed_date' => $currentDate,
                    'ongoing_on' => $currentDateTime,
                    'loan_status' => 2,
                    'nbfc_id' => $validNbfc['id'],
                    'nbfc_name' => $validNbfc['nbfc_name'],
                    'razorpay_key' => $validNbfc['razorpay_key']
                ];

                $response = LoanRequest::where('id', $id)->update($data);

                if ($response) {
                    return response()->json([
                        'success' => true,
                        'message' => $responseMessage,
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => $responseMessage,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong',
        ]);
    }
}
