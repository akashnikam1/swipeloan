@extends('layouts.pdfApp')
@section('content')
    <section class="invoice" id="content">
        <div class="text-center">
            <div id="page_title">
                <span style="text-align: center; font-weight: bold;"><u>NO DUES CERTIFICATE</u></h4>
                    <p style="text-align: right;">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="mt-2">
                    Dear Sir/Madam,
                </p>
                <p>
                    <strong>Sub: No Dues outstanding towards Loan Account Number {{ $loanDetail->loan_number }}</strong>
                </p>
                <p>
                    This is to inform you that there are no dues with respect to the Loan Account Number {{ $loanDetail->loan_number }} for loan
                    applicant Mr./Ms. {{ $userDetail->first_name}} {{ $userDetail->last_name }} residing at {{ $userDetail->current_address }}.
                </p>
                <p>
                    The said applicant has cleared all the outstanding dues and there are no further dues payable to 
                    KGIL Fintech Solutions Private Limited for the aforementioned Loan Account {{ $loanDetail->loan_number }}.
                </p><br>
                <p>
                    Regards,<br>
                    <b>KGIL Fintech Solutions Private Limited</b>
                </p><br>
                <p>
                    <i>This is a system-generated document and does not require any signature. <br>
                        I hereby acknowledge the receipt of No Dues Certificate.</i>
                </p>
                <div class="row mt-5">
                    <div style="width: 180px">
                        <div style="background-color: #757575; height: 1px;"></div>
                        <p>Customer’s Signature</p>
                    </div>
                </div>
            </div>
        </div>
    </section>  
@endsection