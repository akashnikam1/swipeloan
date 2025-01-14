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

class GenerateLoanDocumentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loanId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $sanctionLetterPath = $loanDocumentPDFController->generateSanctionLetter($this->loanId);
        $loanAgreementPath = $loanDocumentPDFController->generateLoanAgreement($this->loanId);
        $keyFactStatementPath = $loanDocumentPDFController->generateKeyFactStatement($this->loanId);

        $baseUrl = config('app.baseURL') . '/storage/app/public/';

        $documentPaths = [
            $baseUrl . $sanctionLetterPath,
            $baseUrl . $loanAgreementPath,
            $baseUrl . $keyFactStatementPath,
        ];

        $loanData = LoanRequest::with('users')->find($this->loanId);

        if ($loanData && $loanData->users) {
            $email = $loanData->users->email;

            $data = [
                'first_name' => $loanData->users->first_name,
                'last_name' => $loanData->users->last_name,
                'subject' => "Congratulations! Your Loan Application Is Approved",
                'lines_count' => 4,
                'content_line1' => "We're thrilled to share the news – your loan application has been approved! Congratulations on this significant step toward achieving your financial goals.",
                'content_line2' => "Your approved loan details, along with repayment terms and disbursement instructions, are outlined below. Our team is here to assist you with any questions you may have as you prepare to move forward.",
                'content_line3' => "You will get the loan amount within 24 hours in your bank account.",
                'content_line4' => "Thank you for choosing us for your financial needs.",
                'document_paths' => $documentPaths,
            ];

            SendEmailJob::dispatch($email, $data);
        }

        Log::info('Loan Document Created Successfully');
    }
}
