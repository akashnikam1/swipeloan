<?php

namespace App\Console\Commands;

use App\Models\LoanRequest;
use Illuminate\Console\Command;
use App\Jobs\GenerateLoanCompletedDocumentJob;

class SendNocDocument extends Command
{
    protected $signature = 'nocDocument:send';

    protected $description = 'Send NOC to customers one month after loan completion';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $oneMonthAgo = now()->subMonth()->toDateString();
        $loanData = LoanRequest::where('loan_status', 3)->whereDate('closed_on', $oneMonthAgo)->get();

        foreach ($loanData as $loan) {
            $loanId = $loan->id;
            GenerateLoanCompletedDocumentJob::dispatch($loanId);
            $this->info("NOC sent for loan number { $loanData->loan_number }");
        }

        return 0;
    }
}
