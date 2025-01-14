@extends('layouts.pdfApp')
@section('content')
    <section class="invoice" id="content">
        <div class="text-center">
            <div id="page_title">
                <span style="text-align: center; font-weight: bold;"><u>KEY FACT STATEMENT</u></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="mt-4">
                    <strong>Date: </strong>{{ \Carbon\Carbon::now()->format('d-m-Y') }} <br>
                    <strong>Name of the Regulated entity: </strong>KGIL Fintech Solutions Private Limited <br>
                    <strong>Applicant Name: </strong>{{ $userDetail->first_name}} {{ $userDetail->last_name }}
                </p>
                
                <table id="myTable">
                    <thead>
                        <tr>
                            <th width="2%">Sr. No.</th>
                            <th width="70%">Parameter</th>
                            <th>Amount (in Rupees) </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>(i)</td>
                            <td>Loan amount (amount disbursed/to be disbursed to the borrower)</td>
                            <td>{{ $loanDetail->loan_amount  }}</td>
                        </tr>
                        <tr>
                            <td>(ii)</td>
                            <td>Total interest charge during the entire tenure of the loan</td>
                            <td>{{ $loanDetail->interest_rate * $loanDetail->number_of_emi }}</td>
                        </tr>
                        <tr>
                            <td>(iii)</td>
                            <td>Up-front charges, if any</td>
                            <td>{{ $loanDetail->up_front_charges + $loanDetail->gst_on_up_front_charges }}</td>
                        </tr>
                        <tr>
                            <td>(iv)</td>
                            <td>Documentation Fee</td>
                            <td>{{ $loanDetail->documentation_fee + $loanDetail->gst_on_documentation_fee }}</td>
                        </tr>
                        <tr>
                            <td>(v)</td>
                            <td>Pre interest amount</td>
                            <td>{{ $loanDetail->pre_interest_amount }}</td>
                        </tr>
                        <tr>
                            <td>(vi)</td>
                            <td>Disbursed amount ((i)-(iii + iv + v))</td>
                            <td>{{ $loanDetail->disbursed_amount }}</td>
                        </tr>
                        <tr>
                            <td>(vii)</td>
                            <td>Post Service fee</td>
                            <td>{{ $loanDetail->post_service_fee +  $loanDetail->gst_on_post_service_fee }} * {{ $loanDetail->number_of_emi }}</td>
                        </tr>
                        <tr>
                            <td>(viii)</td>
                            <td>Technology fee</td>
                            <td>{{ $loanDetail->technology_fee +  $loanDetail->gst_on_technology_fee }} * {{ $loanDetail->number_of_emi }}</td>
                        </tr>
                        <tr>
                            <td>(ix)</td>
                            <td>Total amount to be paid by the borrower (sum of (i), (ii), (vii) and (viii))</td>
                            <td>{{ $loanDetail->emi_amount * $loanDetail->number_of_emi }}</td>
                        </tr>
                        <tr>
                            <td>(x)</td>
                            <td>Annualized interest rate (in percentage)</td>
                            <td>24%</td>
                        </tr>
                        <tr>
                            <td>(xi)</td>
                            <td>Tenure of the Loan (in days)</td>
                            <td>{{ $loanDetail->tenure }} days</td>
                        </tr>
                        <tr>
                            <td>(xii)</td>
                            <td>Repayment frequency by the borrower</td>
                            <td>Fortnightly</td>
                        </tr>
                        <tr>
                            <td>(xiii)</td>
                            <td>Number of instalments of repayment</td>
                            <td>{{ $loanDetail->number_of_emi }}</td>
                        </tr>
                        <tr>
                            <td>(xiv)</td>
                            <td>Amount of each instalment of repayment of Principal + Interest</td>
                            <td>
                                @for($i = 0; $i < $loanDetail->number_of_emi; $i++ )
                                    {{ $loanDetail->emi_amount }} <br>
                                @endfor
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3" style="text-align: left !important;"><strong>Details about Contingent Charges</strong></td>
                        </tr>
                        <tr>
                            <td>(xv) </td>
                            <td>Rate of annualized penal charges in case of delayed payments (if any) </td>
                            <td>1% per day <=1 <br>0.5% per day <=49 <br>0% >49 days</td>
                        </tr>
                        <tr>
                            <td>(xvi) </td>
                            <td>Rate of annualized other penal charges (if any); (details to be provided)  </td>
                            <td>None</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left !important;"><strong>Other disclosures</strong></td>
                        </tr>
                        <tr>
                            <td>(xvii)</td>
                            <td>Cooling off/look-up period during which borrower shall not be charged any
                                penalty on prepayment of loan</td>
                            <td>4 days</td>
                        </tr>
                    </tbody>
                </table>

                <div class="page-break"></div>

                <table id="myTable" style="margin-top: 180px">
                    <thead>
                        <tr>
                            <th width="2%">Sr. No.</th>
                            <th width="70%">Parameter</th>
                            <th>Amount (in Rupees) </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>(xv)</td>
                            <td>Details of LSP acting as recovery agent and authorized to approach the
                                Borrower</td>
                            <td>Fairdebt Solutions Pvt. Ltd. <br>
                                We4U Technologies and Services Pvt Ltd <br>
                                DigiBhoomi <br>
                                Bharath Finnovation <br>
                                GetLux Debt Recovery <br>
                                Associates <br>
                                33 Associates <br>
                                Privatecourt <br>
                                Digi venkatadri solutions <br>
                                Debtfix associate</td>
                        </tr>
                        <tr>
                            <td>(xvi)</td>
                            <td>Name, designation, address and phone number of grievance
                                redressal officer designated specifically to deal with FinTech/ digital
                                lending related complaints/ issues</td>
                            <td style="text-align: left !important">Name: Harshita Gupta <br>
                                Designation: Director <br>
                                Redressal Officer
                                Address: OFFICE NO 219 FLR 2 GERA, 
                                IMPERIUM RISE NR WIPRO, Infotech Park,
                                Hinjawadi, Pune, Haveli, Maharashtra, 
                                India, 411057
                                Telephone no: 020-6666-2622</td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-center">
                    <strong>Detailed Repayment/Account Statement Schedule</strong>
                </p>

                <table id="myTable1">
                    <thead>
                        <tr>
                            <th>Instalment No.</th>
                            <th>Principal (in Rupees)</th>
                            <th>Post Fee + GST</th>
                            <th>Technology Fee + GST</th>
                            <th>Interest (in Rupees)</th>
                            <th>Instalment (in Rupees)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $loanDetail->number_of_emi; $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $loanDetail->loan_amount }}</td>
                            <td>{{ $loanDetail->post_service_fee + $loanDetail->gst_on_post_service_fee }}</td>
                            <td>{{ $loanDetail->technology_fee + $loanDetail->gst_on_technology_fee }}</td>
                            <td>{{ $loanDetail->interest_rate }}</td>
                            <td>{{ $loanDetail->emi_amount }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>

                <p>
                    <strong>Note: Annual Percentage Rate (APR) - 24% </strong><br>
                    For and on the behalf of <strong>KGIL Fintech Solutions Private Limited</strong>
                </p>

                <p>
                    <i>This is a System Generated KFS and does Not Require any Signature.</i>
                </p>
            </div>
        </div>
    </section> 
@endsection