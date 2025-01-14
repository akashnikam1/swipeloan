@extends('layouts.app')
@section('content')
    <style>
        table.dataTable tbody td:nth-child(5) {
            padding: 3px;
        }

        table.dataTable tbody td:nth-child(6) {
            padding: 3px;
        }
    </style>
    
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Loan Limit Request</h3>
                    <div class="nk-block-des">
                        <p>List of all loan limit requests</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt d-block d-sm-none">
                                    <a href="#" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <div class="form-group">
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
                        <li>
                            <div class="form-group">
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Income Amount</th>
                                <th>Company Name</th>
                                <th>Credit Limit</th>
                                <!--<th>Salary Slip</th>-->
                                <th>Bank Statement</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Loan Limit Modal --}}

    <div class="modal fade" tabindex="-1" id="updateLoanLimitModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-bs-label="Close"> <em
                        class="icon ni ni-cross"></em> </a>
                <div class="modal-header">
                    <h5 class="modal-title">Update Loan Limit</h5>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ url('loan_limit_requests/update') }}">
                        @csrf
                        <input type="hidden" name="id" id="loan_limit_request_id" value="{{ old('id') }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="credit_limit">Credit Limit</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('credit_limit') is-invalid @enderror"
                                            name="credit_limit" id="credit_limit" value="{{ old('credit_limit') }}" placeholder="Credit Limit">
                                        @if ($errors->has('credit_limit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('credit_limit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var userId = $(this).data('user-id');
                $('#loan_limit_request_id').val(id); 
                $('#user_id').val(userId); 
                $('#updateLoanLimitModal').modal('show');
            });

            @if(session('showCreditModal'))
                $('#loan_limit_request_id').val('{{ session('id') }}'); 
                $('#user_id').val('{{ session('user_id') }}'); 
                $('#updateLoanLimitModal').modal('show');
            @endif

            datatable1();
        });

        $('#from_date, #to_date').change(function() {
            $("#myTable").DataTable().clear().destroy();
            datatable1();
        });

        function datatable1() {
            from_date = $("#from_date").val();
            to_date = $("#to_date").val();

            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                ajax: "{{ url('loan_limit_requests/all') }}?from_date=" + from_date + "&to_date=" + to_date,
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
                        "mData": "users.first_name",
                        render: function(data, type, row) {
                            if (row.users.last_name != null) {
                                var fullName = row.users.first_name + " " + row.users.last_name;
                                var truncatedText = data.length > 10 ? data.substr(0, 10) + '...' : data;
                                return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    fullName + "' data-placement='top'>" + truncatedText + "</span>";
                            } else {
                                return "NA";
                            }
                        }
                    },
                    {
                        "mData": "income_amount"
                    },
                    {
                        "targets": -1,
                        "mData": "company_name",
                        render: function(data, type, row) {
                            if (row.company_name != null) {
                                var truncatedText = data.length > 10 ? data.substr(0, 10) + '...' : data;
                                return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    row.company_name + "' data-placement='top'>" + truncatedText + "</span>";
                            }
                        }
                    },
                    {
                        "mData": "credit_limit",
                        render: function(data, type, row, meta) {
                            if (row.credit_limit != null) {
                                return data;
                            } else {
                                return "NA";
                            }
                        }
                    },
                    // {
                    //     "mData": "salary_slip",
                    //     render: function(data, type, row, meta) {
                    //         return '<a href="{{ asset('storage/app/public') }}/' + data + '" target="_blank" style="font-size:22px"><em class="icon ni ni-file-pdf"></em></a>';
                    //     }
                    // },
                    {
                        "mData": "bank_statement",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ asset('storage/app/public') }}/' + data + '" target="_blank" style="font-size:22px; margin-top: -10px;"><em class="icon ni ni-file-pdf"></em></a>';
                        }
                    },
                    {
                        "mData": "created_at",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        "mData": "status",
                        render: function(data, type, row) {
                            if (row.status == 0) {
                                return "<h6 class='text-danger sub-text' style='margin-top:2px;'>Pending</h6>";
                            } else if(row.status == 1){
                                return "<h6 class='text-success sub-text' style='margin-top:2px;'>Completed</h6>";
                            } else {
                                return "<h6 class='text-dark sub-text' style='margin-top:2px;'>NA</h6>";
                            }
                        }
                    },
                    {
                        "mData": "action"
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.status == 1) {
                        $(row).find('.edit-btn').attr('disabled', 'disabled').addClass('disabled');
                    }

                    $('td:eq(4)', row).css({
                        "padding": "3px 0 0 0 3px",
                    });

                    $('td:eq(5)', row).css({
                        "padding": "3px 0 0 0 3px",
                    });
                }
            });
        }
    </script>
@endsection
