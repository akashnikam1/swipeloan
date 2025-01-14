<?php

namespace App\Console\Commands;

use App\Helpers\PaymentHelper;
use App\Models\LoanRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ApplyBounceCharges extends Command
{
    protected $signature = 'apply:bounce_charges';

    protected $description = 'Apply Bounce Charges when due date is Passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();

        $loanIds = LoanRequest::where('loan_status', 2)->pluck('id');
        $payments = Payment::whereIn('loan_id', $loanIds)
            ->where('status', 0)
            ->whereDate('payment_date', '<=', $today)
            ->get();

        foreach ($payments as $payment) {
            $emiCharges = PaymentHelper::calculateEMIBounceCharges($payment);

            $payment->update([
                'enach_charges' => $emiCharges['enach_charges'],
                'gst_on_enach_charges' => $emiCharges['gst_on_enach_charges'],
                'bounce_charges' => $emiCharges['bounce_charges'],
                'total_amount' => $emiCharges['total_amount'],
            ]);

            $this->info("Processed payment ID {$payment->id} with total amount {$emiCharges['total_amount']}");
        }

        return 0;
    }
}
