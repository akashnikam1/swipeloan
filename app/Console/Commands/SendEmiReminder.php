<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\V1\WebApiController;
use App\Models\LoanRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class SendEmiReminder extends Command
{
    protected $signature = 'emiReminder:send';

    protected $description = 'Send EMI reminders to users';

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

        if ($payments->isNotEmpty()) {
            $api = new WebApiController();
            $api->sendEMIReminders($payments);
        }

        Log::info("EMI reminders sent successfully");

        return 0;
    }
}
