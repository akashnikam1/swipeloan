@extends('layouts.pdfApp')
@section('style')
    <style>
        ol li{
            margin-bottom: 4px;
        }
    </style>
@endsection
@section('content')
    <section class="invoice" id="content">
        <div class="text-center">
            <div id="page_title">
                <span style="text-align: center; font-weight: bold;"><u>SANCTION LETTER</u></h4>
                <p style="text-align: right;">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="mt-2">
                    To,<br>
                    Mr./Ms.
                </p>
                <p>
                    <strong>Sub: Loan Sanction Letter</strong>
                </p>
                <p>
                    <strong>Ref: Loan Application No {{ $loanDetail->loan_number }}</strong>
                </p>
                <p class="mt-3">
                    Dear Sir/Ma’am
                </p>
                <p>
                    This has reference to your above referred application for an Insta Fund Loan (”Loan”)
                    on behalf of KGIL Fintech Solutions Private Limited and based on the details/
                    documents provided by you for verification through our Application.
                </p>
                <p>
                    PayRupik is pleased to inform you about according of ‘in principle’ sanction of a loan
                    on the terms and conditions as mentioned below:
                </p>

                <ol id="termslist">
                    <li><strong>I. Loan Amount:</strong> INR {{ \App\Helpers\NumberHelper::amountInWords($loanDetail->loan_amount) }} ONLY</li>
                    <li><strong>II. Rate of Interest:</strong> Applicable as per market conditions prevalent at the time of disbursement.</li>
                    <li><strong>III. Type of Rate of Interest:</strong> Simple</li>
                    <li><strong>IV. Payment Mode:</strong> To be paid in the name of NBFC (KGIL Fintech Solutions Private Limited) through the link on the Mobile Application.</li>
                    <li><strong>V. Repayment Tenure:</strong> {{ $loanDetail->tenure }} Days</li>
                    <li><strong>VI. Applicable EMI:</strong> INR {{ \App\Helpers\NumberHelper::amountInWords($loanDetail->total_emi_amount) }} ONLY</li>
                    <li><strong>VII. Validity of this offer:</strong> This sanction/offer letter will automatically stand withdrawn if the disbursement is not availed of within 7 (seven) working days from the date of issue of this sanction letter.</li>
                    <li><strong>VIII.</strong> Consequent to the Sanction letter and on disbursement/ sanction of Loan Amount the Loan Agreement be tendered.</li>
                    <li><strong>IX. </strong> The company reserves the right to grant a provision where the borrower can extend the tenure of the loan with the applicable processing fee provided the borrower clears all the overdue charges if any pending with the last loan transaction before applying for an extension.</li>
                </ol>

                <div class="page-break"></div>

                <ol style="margin-top: 170px;">
                    <li><strong>X.</strong> Also the Company reserves the right to cancel the Application on valid grounds before the disbursement of Loan Amount as mentioned.</li>
                </ol>

                <p>
                    For and on the behalf of KGIL Fintech Solutions Private Limited
                </p>

                <img src="{{ asset('assets/images/director_signature.jpeg') }}" alt="" width="220px" height="100px">

                <p style="margin-top: 15px;">
                    Name: Harshita Gupta <br>
                    Authorised Representative <br>
                    Designation: Director
                </p>
            </div>
        </div>
    </section>  
@endsection