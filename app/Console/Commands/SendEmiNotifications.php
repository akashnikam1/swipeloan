<?php

namespace App\Console\Commands;

use App\Models\LoanRequest;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Payment;
use App\Jobs\SendPushNotificationJob;
use Illuminate\Support\Facades\Log;

class SendEmiNotifications extends Command
{
    protected $signature = 'emiNotification:send';

    protected $description = 'Send EMI notifications to users';

    public function __construct()
    {
        parent::__construct();
    }   

    public function handle()
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

                if ($user && $user->is_active) {
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

        return 0;
    }
}
