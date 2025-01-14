<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\LoanDocument;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class LoanDocumentPDFController extends Controller
{
    // Key Fact Statement

    public function generateKeyFactStatement($loanId)
    {
        $loanRequest = LoanRequest::where('id', $loanId)->first();
        $user = User::where('id', $loanRequest->user_id)->first();

        $data['loanDetail'] = $loanRequest;
        $data['userDetail'] = $user;
        
        $pdfOptions = [
            'font' => 'sans-serif',
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ];

        $pdf = Pdf::loadView('pdf_templates.kfs', $data)->setOptions($pdfOptions);

        $number = rand(1111111, 999999);
        $filename = $user->first_name . '_KFS_' . $number . '.pdf';
        $loanDocumentPath = 'LoanDocuments/' . $filename;

        Storage::disk('public')->put($loanDocumentPath, $pdf->output());

        $date = Carbon::now()->format('d-M-Y');
        LoanDocument::create([
            'loan_id' => $loanId,
            'document_url' => $loanDocumentPath,
            'document_name' => 'Key Fact Statement',
            'date' => $date
        ]);

        return $loanDocumentPath;
    }

    // Sanction Letter 

    public function generateSanctionLetter($loanId)
    {
        $loanRequest = LoanRequest::where('id', $loanId)->first();
        $user = User::where('id', $loanRequest->user_id)->first();

        $data['loanDetail'] = $loanRequest;
        $data['userDetail'] = $user;

        $pdfOptions = [
            'font' => 'sans-serif',
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ];

        $pdf = Pdf::loadView('pdf_templates.sanction_letter', $data)->setOptions($pdfOptions);

        $number = rand(1111111, 999999);
        $filename = $user->first_name . '_Sanction_Letter_' . $number . '.pdf';
        $loanDocumentPath = 'LoanDocuments/' . $filename;

        Storage::disk('public')->put($loanDocumentPath, $pdf->output());

        $date = Carbon::now()->format('d-M-Y');
        LoanDocument::create([
            'loan_id' => $loanId,
            'document_url' => $loanDocumentPath,
            'document_name' => 'Sanction Letter',
            'date' => $date
        ]);

        return $loanDocumentPath;
    }

    // Loan Agreement 

    public function generateLoanAgreement($loanId)
    {
        $loanRequest = LoanRequest::where('id', $loanId)->first();
        $user = User::where('id', $loanRequest->user_id)->first();
        $payments = Payment::where('loan_id', $loanId)->orderBy('id', 'ASC')->get();

        $data['loanDetail'] = $loanRequest;
        $data['userDetail'] = $user;
        $data['payments'] = $payments;
        $data['isESigned'] = 1;

        $pdfOptions = [
            'font' => 'sans-serif',
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ];

        $pdf = Pdf::loadView('pdf_templates.loan_agreement', $data)->setOptions($pdfOptions);

        $number = rand(1111111, 999999);
        $filename = $user->first_name . '_Loan_Agreement_' . $number . '.pdf';
        $loanDocumentPath = 'LoanDocuments/' . $filename;

        Storage::disk('public')->put($loanDocumentPath, $pdf->output());

        $date = Carbon::now()->format('d-M-Y');
        LoanDocument::create([
            'loan_id' => $loanId,
            'document_url' => $loanDocumentPath,
            'document_name' => 'Loan Agreement',
            'date' => $date
        ]);

        return $loanDocumentPath;
    }

    // No Dues Certificate (NOC)

    public function generateNoDuesCertificate($loanId)
    {
        $loanRequest = LoanRequest::where('id', $loanId)->first();
        $user = User::where('id', $loanRequest->user_id)->first();

        $data['loanDetail'] = $loanRequest;
        $data['userDetail'] = $user;

        $pdfOptions = [
            'font' => 'sans-serif',
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ];

        $pdf = Pdf::loadView('pdf_templates.no_dues_certificate', $data)->setOptions($pdfOptions);

        $number = rand(1111111, 999999);
        $filename = $user->first_name . '_No_Dues_Certificate_' . $number . '.pdf';
        $loanDocumentPath = 'LoanDocuments/' . $filename;

        Storage::disk('public')->put($loanDocumentPath, $pdf->output());

        $date = Carbon::now()->format('d-M-Y');
        LoanDocument::create([
            'loan_id' => $loanId,
            'document_url' => $loanDocumentPath,
            'document_name' => 'No Dues Certificate',
            'date' => $date
        ]);

        return $loanDocumentPath;
    }

    // Loan Agreement Before E-SIGN

    public function generateLoanAgreementBeforeESign($loanId)
    {
        $loanRequest = LoanRequest::where('id', $loanId)->first();
        $user = User::where('id', $loanRequest->user_id)->first();
        $payments = Payment::where('loan_id', $loanId)->orderBy('id', 'ASC')->get();

        $data['loanDetail'] = $loanRequest;
        $data['userDetail'] = $user;
        $data['payments'] = $payments;
        $data['isESigned'] = 0;

        $pdfOptions = [
            'font' => 'sans-serif',
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ];

        $pdf = Pdf::loadView('pdf_templates.loan_agreement', $data)->setOptions($pdfOptions);

        $number = rand(1111111, 999999);
        $filename = $user->first_name . '_Loan_Agreement_' . $number . '.pdf';
        $loanDocumentPath = 'LoanAgreements/' . $filename;

        Storage::disk('public')->put($loanDocumentPath, $pdf->output());
        return $loanDocumentPath;
    }
}