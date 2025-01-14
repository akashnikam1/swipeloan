<?php

namespace App\Jobs;

use App\Http\Controllers\LoanDocumentPDFController;
use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateLoanCompletedDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $loanId;

    public function __construct($loanId)
    {
        $this->loanId = $loanId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loanDocumentPDFController = new LoanDocumentPDFController();
        $nocPath = $loanDocumentPDFController->generateNoDuesCertificate($this->loanId);

        $baseUrl = config('app.baseURL') . '/storage/app/public/';

        $documentPaths = [
            $baseUrl . $nocPath,
        ];

        $loanData = LoanRequest::with('users')->find($this->loanId);

        if ($loanData && $loanData->users) {
            $email = $loanData->users->email;

            $data = [
                'first_name' => $loanData->users->first_name,
                'last_name' => $loanData->users->last_name,
                'subject' => "Your No Objection Certificate (NOC) for Loan No " . $loanData->loan_number,
                'lines_count' => 3,
                'content_line1' => "We are pleased to inform you that your loan has been successfully completed and closed. As a result, we have issued a No Objection Certificate (NOC) for your loan account.",
                'content_line2' => "Please find the attached NOC document for your records. The NOC certifies that there are no outstanding dues on the aforementioned loan and confirms that the loan has been fully repaid.",
                'content_line3' => "Thank you for choosing us for your financial needs.",
                'document_paths' => $documentPaths,
            ];

            SendEmailJob::dispatch($email, $data);
        }

        Log::info('Loan Completed Document Created Successfully');
    }
}
