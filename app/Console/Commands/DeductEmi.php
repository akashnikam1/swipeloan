<?php

namespace App\Console\Commands;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\BillDeskController;
use App\Jobs\SendEmailJob;
use App\Jobs\SendPushNotificationJob;
use App\Models\ENachTransaction;
use App\Models\LoanRequest;
use App\Models\LoanStage;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeductEmi extends Command
{
    protected $signature = 'emi:deduct';

    protected $description = 'Deduct EMIs for loans';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $endDate = $today->copy()->day(5);
        $startDate = $endDate->copy()->subMonths(3)->day(6);

        $loanIds = LoanRequest::where('loan_status', 2)->pluck('id');
        $payments = Payment::whereIn('loan_id', $loanIds)
            ->where('status', 0)
            ->whereDate('payment_date', '>=', $startDate)
            ->whereDate('payment_date', '<=', $endDate)
            ->orderBy('id', 'ASC')
            ->get();

        if ($payments->isEmpty()) {
            $this->info('No pending payments found for EMI processing.');
        } else {
            foreach ($payments as $payment) {
                // Calculate EMI Bounce Charges

                $emiCharges = PaymentHelper::calculateEMIBounceCharges($payment);

                $amount = $payment->payment_amount;
                $eNachCharges = $emiCharges['enach_charges'];
                $gstOnENachCharges = $emiCharges['gst_on_enach_charges'];
                $bounceCharges = $emiCharges['bounce_charges'];
                $totalAmount = $emiCharges['total_amount'];

                // BillDesk Payment Integration

                $billdesk = new BillDeskController();
                $response = $billdesk->createTransaction($totalAmount);

                ENachTransaction::create([
                    'payment_id' => $payment->id,
                    'amount' => $amount,
                    'enach_charges' => $eNachCharges,
                    'gst_on_enach_charges' => $gstOnENachCharges,
                    'bounce_charges' => $bounceCharges,
                    'enach_status' => ($response['status'] === true) ? 1 : 0,
                    'is_enach' => 1,
                    'enach_date' => $today,
                    'enach_response' => $response,
                ]);

                $user = User::where('id', $payment->user_id)->first();

                $enachTransactionCount = ENachTransaction::where('payment_id', $payment->id)->count();
                if ($enachTransactionCount == 15) {
                    $user->is_defaulter = 1;
                    $user->defaulter_date = $today;
                    $user->save();
                }

                if ($response['status'] === false) {
                    $payment->billdesk_response = $response;
                    $payment->save();

                    $data = [
                        'notification_id' => '',
                        'title' => 'EMI is not deducted',
                        'description' => 'Hello ' . $user->first_name . ', Your EMI is not deducted.',
                        'image' => '',
                        'user_id' => $user->id,
                        'firebase_token' => [$user->firebase_token],
                    ];

                    SendPushNotificationJob::dispatch($data);
                }

                if ($response['status'] === true) {
                    $currentDateTime = Carbon::now();
                    $currentDateWithTime = $currentDateTime->format('Y-m-d H:i:s');

                    $lastPayment = Payment::where('user_id', $payment->user_id)
                        ->orderBy('payment_date', 'desc')
                        ->first();

                    $loanRequest = LoanRequest::where('id', $payment->loan_id)->first();

                    if ($lastPayment && $payment->id == $lastPayment->id) {
                        if ($loanRequest) {
                            $loanRequest->loan_status = 3;
                            $loanRequest->closed_on = $currentDateWithTime;
                            $loanRequest->save();
                        }

                        $email = $user->email;
                        $data = [
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'subject' => "Congratulations! Your Loan is Successfully Completed",
                            'lines_count' => 3,
                            'content_line1' => "We are delighted to inform you that your loan has been successfully completed. We appreciate your commitment and timely payments throughout the loan tenure.",
                            'content_line2' => "We would like to extend our gratitude for choosing us. It has been a pleasure serving you, and we hope to assist you with your future financial endeavors. You will recieve NOC to registered email within a 1 month.",
                            'content_line3' => "Thank you for choosing us for your financial needs.",
                        ];

                        SendEmailJob::dispatch($email, $data);

                        $notificationData = [
                            'notification_id' => '',
                            'title' => 'Loan is Successfully Completed',
                            'description' => 'Hello ' . $user->first_name . ', We are delighted to inform you that your loan has been successfully completed.',
                            'image' => '',
                            'user_id' => $user->id,
                            'firebase_token' => [$user->firebase_token],
                        ];

                        SendPushNotificationJob::dispatch($notificationData);

                        if ($user) {
                            $user->loan_status = 0;

                            $loanStageCount = LoanStage::where('is_active', 1)->count();

                            $user->loan_status = 0;

                            if ($user->loan_stage > 3) {
                                $currentLoanStage = LoanStage::where('id', $user->loan_stage)->first();

                                if ($currentLoanStage) {
                                    $loanAmount = $currentLoanStage->amount;

                                    $loanRequestCount = LoanRequest::where('user_id', $user->id)
                                        ->where('loan_amount', $loanAmount)
                                        ->count();

                                    if ($loanRequestCount >= 2) {
                                        if ($user->loan_stage < $loanStageCount) {
                                            $user->loan_stage = $user->loan_stage + 1;
                                        }
                                    }
                                }
                            } else {
                                if ($user->loan_stage < $loanStageCount) {
                                    $user->loan_stage = $user->loan_stage + 1;
                                }
                            }

                            $user->save();
                        }
                    }

                    if ($lastPayment && $payment->id !== $lastPayment->id) {
                        $paymentDate = $payment->payment_date;
                        $dueDate = Carbon::parse($paymentDate)->addMonth();
                        $loanRequest->due_on = $dueDate->format('Y-m-d');
                        $loanRequest->save();
                    }

                    $data = [
                        'notification_id' => '',
                        'title' => 'EMI is deducted',
                        'description' => 'Hello ' . $user->first_name . ', Your EMI is deducted.',
                        'image' => '',
                        'user_id' => $user->id,
                        'firebase_token' => [$user->firebase_token],
                    ];

                    SendPushNotificationJob::dispatch($data);

                    $payment->transaction_id = $response['transaction_id'];
                    $payment->enach_charges = $eNachCharges;
                    $payment->gst_on_enach_charges = $gstOnENachCharges;
                    $payment->bounce_charges = $bounceCharges;
                    $payment->total_amount = $totalAmount;
                    $payment->payment_mode = "Billdesk";
                    $payment->status = 1;
                    $payment->payment_completed_date = $currentDateWithTime;
                    $payment->billdesk_response = $response;
                    $payment->save();

                    Log::info("EMIs deducted successfully for loan number of $loanRequest->loan_number with payment of $payment->amount which is due on $payment->payment_date.");
                }
            }
        }

        return 0;
    }
}
