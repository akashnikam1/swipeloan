@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Loan Request</h3>
                    <div class="nk-block-des">
                        <p>List of all loan requests</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content"></div>
                        <div class="nk-block-head-content col-lg-11">
                            <ul class="nk-block-tools g-2 col-lg-12">
                                <li class="col-lg-3">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-ui="lg" data-search="on" name="loan_status" id="loan_status">
                                                <option value="select_loan_status" selected disabled>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Approved</option>
                                                <option value="2">Ongoing</option>
                                                <option value="3">Closed</option>
                                                <option value="4">Declined</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-4">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;"><em
                                                    class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                class="form-control form-control-lg form-control-outlined date-picker @error('from_date') is-invalid @enderror"
                                                value="" name="from_date" id="from_date">
                                            <label class="form-label-outlined" for="from_date">From Date</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-4">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;"><em
                                                    class="icon ni ni-calendar-alt"></em></div>
                                            <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                class="form-control form-control-lg form-control-outlined date-picker @error('to_date') is-invalid @enderror"
                                                value="" name="to_date" id="to_date">
                                            <label class="form-label-outlined" for="to_date">To Date</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-1">
                                    <button style="padding:10px 15px;" type="button" id="download-report" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Report">
                                            <em class="icon ni ni-download-cloud"></em>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Loan Number</th>
                                <th>Name</th>
                                <th>Loan Amount</th>
                                <th>Disbursed Amount</th>
                                <th>Disbursed Date</th>
                                <th>Request Date</th>
                                <th>Loan Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            datatable1();
        });

        $('#from_date, #to_date').change(function() {
            $("#myTable").DataTable().clear().destroy();
            datatable1();
        });

        $('#loan_status').change(function() {
            $("#myTable").DataTable().clear().destroy();
            datatable1();
        });

        function datatable1() {
            from_date = $("#from_date").val();
            to_date = $("#to_date").val();
            loan_status = $("#loan_status").val();

            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: "{{ url('loan_requests/all') }}?from_date=" + from_date + "&to_date=" + to_date + "&loan_status=" + loan_status,
                "order": [
                    // [0, "desc"]
                ],
                responsive: !0,
                autoFill: !0,
                keys: !0,
                lengthMenu: [
                    [10, 100, 500, -1],
                    [10, 100, 500, "All"]
                ],

                "columns": [
                    {
                        "targets": -1,
                        "mData": "loan_number",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ url('loan_requests/loan_details') }}/' + row.id + '"><span>' + data + '</span></a>';
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "loan_users.first_name",
                        render: function(data, type, row, meta) {
                            if (row.loan_users.last_name != null) {
                                return data + ' ' + row.loan_users.last_name;
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        "mData": "loan_amount"
                    },
                    {
                        "mData": "disbursed_amount"
                    },
                    {
                        "mData": "disbursed_date"
                    },
                    {
                        "mData": "pending_on",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "loan_status",
                        render: function(data, type, row) {
                            if (row.loan_status == 0) {
                                return "<h6 class='text-warning sub-text' style='margin-top:2px;'>Pending</h6>";
                            } else if(row.loan_status == 1){
                                return "<h6 class='text-success sub-text' style='margin-top:2px;'>Approved</h6>";
                            }else if(row.loan_status == 2){
                                return "<h6 class='text-primary sub-text' style='margin-top:2px;'>Ongoing</h6>";
                            }else if(row.loan_status == 3){
                                return "<h6 class='text-info sub-text' style='margin-top:2px;'>Closed</h6>";
                            }else if(row.loan_status == 4){
                                return "<h6 class='text-danger sub-text' style='margin-top:2px;'>Declined</h6>";
                            }else {
                                return "<h6 class='text-dark sub-text' style='margin-top:2px;'>NA</h6>";
                            }
                        }
                    },
                ]
            });
        }

        document.getElementById('download-report').addEventListener('click', function(event) {
            event.preventDefault();

            var startDate = $("#from_date").val();
            var endDate = $("#to_date").val();
            var loanStatus = $("#loan_status").val();

            var queryParams = new URLSearchParams();
            if (loanStatus) {
                queryParams.append('loanStatus', loanStatus);
            }
            if (startDate) {
                queryParams.append('startDate', startDate);
            }
            if (startDate) {
                queryParams.append('endDate', endDate);
            }

            const baseURL = "{{ url('/') }}";
            const fullURL = `${baseURL}/download/loan_report?${queryParams.toString()}`;
            window.location.href = fullURL;
        });
    </script>
@endsection
