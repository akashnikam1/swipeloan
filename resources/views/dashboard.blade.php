@extends('layouts.app')
@section('style')
    <style>
        .row .card {
            border-radius: 12px;
        }
    </style>
@endsection
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Dashboard</h3>
                    <p>Welcome to SwipeLoan!</p>
                </div>
                <div class="nk-block-head-content">
                    <form id="dateFilterForm" method="GET" action="{{ route('dashboard') }}">
                        <ul class="nk-block-tools g-2">
                            <li class="col-lg-6">
                                <div class="form-group col-lg-12">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;"><em
                                                class="icon ni ni-calendar-alt"></em>
                                        </div>
                                        <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                            class="form-control form-control-lg form-control-outlined date-picker @error('from_date') is-invalid @enderror"
                                            value="{{ request('from_date') }}" name="from_date" id="from_date"
                                            onchange="checkAndSubmit()">
                                        <label class="form-label-outlined" for="from_date">From Date</label>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6">
                                <div class="form-group col-lg-12">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;"><em
                                                class="icon ni ni-calendar-alt"></em></div>
                                        <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                            class="form-control form-control-lg form-control-outlined date-picker @error('to_date') is-invalid @enderror"
                                            value="{{ request('to_date') }}" name="to_date" id="to_date"
                                            onchange="checkAndSubmit()">
                                        <label class="form-label-outlined" for="to_date">To Date</label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="row g-gs mt-2">
                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Users</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_user" class="fs-1 text-dark">{{ $userCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Stage-1</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_user" class="fs-1 text-dark">{{ $personalDetailStageCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Personal Details Completed Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Stage-2</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_user" class="fs-1 text-dark">{{ $kycDetailStageCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total KYC Details Completed Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Stage-3</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_user" class="fs-1 text-dark">{{ $bankVerificationStageCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Bank Details Completed Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Stage-4</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_user" class="fs-1 text-dark">{{ $incomeDetailStageCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Income Details Completed Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Banners</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('banners/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_banners" class="fs-1 text-dark">{{ $bannerCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Banners</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Partners</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('partners/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_partners" class="fs-1 text-dark">{{ $partnerCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Partners</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Defaulter Users</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('defaulters_users/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_defaulter_users" class="fs-1 text-dark">{{ $defaulterCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Defaulter Users</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Contact Us</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('contact_us/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_defaulter_users" class="fs-1 text-dark">{{ $contactUsCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Contact Us</div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-4">
                    <div class="card card-full card-bordered">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0">
                                    <h6 class="title">Feedbacks</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('user_feedbacks/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_defaulter_users" class="fs-1 text-dark">{{ $feedbackCount }}</h5>
                            <div class="fs-7 text-dark text-opacity-75 mt-1">Total Feedbacks</div>
                        </div>
                    </div>
                </div> -->
                
                <div class="col-xl-12">
                    <div class="card card-bordered h-100">
                        <div class="card-inner">
                            <div class="card-title-group pb-3 g-2">
                                <div class="card-title card-title-sm">
                                    <h6 class="title">EMI and Profit Collection</h6>
                                    <p>
                                        How have your EMI, Profit and Disbursed Amount metrics trended?
                                    </p>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('payments/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="analytic-ov">
                                <div class="analytic-data-group analytic-ov-group g-3">
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Users</div>
                                        <div class="amount">{{ $userCount }}</div>
                                    </div>
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">EMI Collection</div>
                                        <div class="amount">{{ $emiCollection }} <span style="font-size: 18px">Rs</span></div>
                                    </div>
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Profit Collection</div>
                                        <div class="amount">{{ $profit }} <span style="font-size: 18px">Rs</span></div>
                                    </div>
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Disbursed Amount</div>
                                        <div class="amount">{{ $disbursedAmount }} <span style="font-size: 18px">Rs</span></div>
                                    </div>
                                </div>
                                <div class="analytic-ov-ck">
                                    <canvas
                                        class="analytics-line-large"
                                        id="analyticOvPaymentData"
                                        width="497"
                                        height="175"
                                        style="
                                            display: block;
                                            box-sizing: border-box;
                                            height: 175px;
                                            width: 497px;">
                                    </canvas>
                                </div>
                            
                                <div class="chart-label-group ms-5">
                                    <div class="chart-label">{{ $startOfMonth }}</div>
                                    <div class="chart-label d-none d-sm-block">
                                        {{ $middleOfMonth }}
                                    </div>
                                    <div class="chart-label">{{ $endOfMonth }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-bordered card-full">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Recent Loan Limit Requests</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('loan_limit_requests/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <ul class="nk-activity is-scrollable h-325px">
                            @if($loanLimitRequests->isEmpty())
                                <li class="nk-activity-item">
                                    <div class="nk-activity-data">
                                        <div class="label">Loan Limit Request Not Found</div>
                                    </div>
                                </li>
                            @else
                                @foreach ($loanLimitRequests as $request)
                                    <li class="nk-activity-item">
                                        <div class="nk-activity-media user-avatar bg-primary">
                                            {{ strtoupper(substr($request->users->first_name, 0, 1)) . strtoupper(substr($request->users->last_name, 0, 1)) }}
                                        </div>
                                        <div class="nk-activity-data">
                                            <div class="label">{{ $request->users->first_name }} {{ $request->users->last_name }} | {{ $request->users->company_name }}</div>
                                            <span class="time">{{ $request->created_at->diffForHumans() }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card card-bordered h-100">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title card-title-sm">
                                    <h6 class="title">Loan Requests</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="active">
                                            <a href="{{ url('loan_requests/all') }}"><span>See History</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="traffic-channel">
                                <div class="traffic-channel-doughnut-ck">
                                    <canvas class="analytics-doughnut" id="LoanRequestDoughnutData" width="415" height="160"></canvas>
                                </div>
                                <div class="traffic-channel-group g-2">
                                    @if(empty($statusCounts['pending']) && empty($statusCounts['approved']) && empty($statusCounts['ongoing']) && empty($statusCounts['closed']))
                                        <div class="traffic-channel-data">
                                            <div class="title">
                                                <span class="dot dot-lg sq" style="background-color: rgba(108, 117, 125, 0.6)"></span>
                                                <span >Data Not Found</span>
                                            </div>
                                        </div>
                                    @else
                                        @foreach(['pending', 'approved', 'ongoing', 'closed'] as $status)
                                            <div class="traffic-channel-data">
                                                <div class="title">
                                                    <span class="dot dot-lg sq 
                                                        @if($status === 'pending') bg-warning 
                                                        @elseif($status === 'approved') bg-primary 
                                                        @elseif($status === 'ongoing') bg-success 
                                                        @else bg-danger @endif">
                                                    </span>
                                                    <span>{{ ucfirst($status) }}</span>
                                                </div>
                                                <div class="amount">{{ $statusCounts[$status] }} <small>{{ $percentages[$status] }}%</small></div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>                                                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptJs')
    <script>
        var loanRequestCounts = @json($statusCounts);
        var LoanRequestDoughnutData;

        if (
            loanRequestCounts.pending === 0 &&
            loanRequestCounts.approved === 0 &&
            loanRequestCounts.ongoing === 0 &&
            loanRequestCounts.closed === 0
        ) {
            LoanRequestDoughnutData = {
                labels: ["0 (No Data)"],
                dataUnit: '%',
                legend: false,
                datasets: [{
                    borderColor: "#fff",
                    background: ["rgba(108, 117, 125, 0.6)"],
                    data: [100]
                }]
            };
        } else {
            LoanRequestDoughnutData = {
                labels: ["Pending", "Approved", "Ongoing", "Closed"],
                dataUnit: '',
                legend: false,
                datasets: [{
                    borderColor: "#fff",
                    background: [
                        "rgba(255, 193, 7, 0.6)", 
                        "rgba(0, 123, 255, 0.6)", 
                        "rgba(40, 167, 69, 0.6)", 
                        "rgba(220, 53, 69, 0.6)"  
                    ],
                    data: [
                        loanRequestCounts.pending, 
                        loanRequestCounts.approved, 
                        loanRequestCounts.ongoing, 
                        loanRequestCounts.closed
                    ]
                }]
            };
        }

        var analyticOvPaymentData = {
            labels:  @json($analyticOvPaymentData['labels']),
            dataUnit: 'Rs',
            lineTension: .1,
            datasets: [{
                label: "Current Month",
                color: "#798bff",
                dash: [0, 0],
                background: NioApp.hexRGB('#798bff', .15),
                data: @json($analyticOvPaymentData['paymentData']),
            }]
        };

        function checkAndSubmit() {
            var fromDate = document.getElementById('from_date').value;
            var toDate = document.getElementById('to_date').value;

            if (fromDate && toDate) {
                document.getElementById('dateFilterForm').submit();
            }
        }
    </script>
@endsection 