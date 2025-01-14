@extends('layouts.app')
@section('content')
    <style>
        table.dataTable tbody td:nth-child(10) {
            padding: 3px;
        }

        table.dataTable tbody td:nth-child(11) {
            padding: 3px;
        }

        table.dataTable tbody td:nth-child(12) {
            padding: 3px;
        }

        table.dataTable tbody td:nth-child(13) {
            padding: 3px;
        }
    </style>

    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Business Loan Enquiry</h3>
                    <div class="nk-block-des">
                        <p>List of all business loan enquiries</p>
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
                        <li class="col-lg-1">
                            <button style="padding:10px 15px;" type="button" id="download-report" class="btn btn-primary"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Report">
                                <em class="icon ni ni-download-cloud"></em>
                            </button>
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
                                <th>Phone Number</th>
                                <th>Age</th>
                                <th>Constitution</th>
                                <th>Bank Account Type</th>
                                <th>Office Ownership</th>
                                <th>Residence Ownership</th>
                                <th>Business Vintage</th>
                                <th>Request Date</th>
                                <th>Bank Statement</th>
                                <th>Shop Act</th>
                                <th>ITR</th>
                                <th>GSTIN</th>
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
                ajax: "{{ url('business_loan_enquiry/all') }}?from_date=" + from_date + "&to_date=" + to_date,
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
                        "mData": "users.phone_number"
                    },
                    {
                        "mData": "age_of_applicant"
                    },
                    {
                        "mData": "consitution_of_applicant"
                    },
                    {
                        "mData": "type_of_bank_account"
                    },
                    {
                        "mData": "office_ownership"
                    },
                    {
                        "mData": "residence_ownership"
                    },
                    {
                        "mData": "business_vintage",
                        "render": function (data, type, row, meta) {
                            if (data == 1) {
                                return data + ' year';
                            } else {
                                return data + ' years';
                            } 
                        }
                    },
                    {
                        "mData": "created_at",
                        "render": function (data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        "mData": "bank_statement",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ asset('storage/app/public') }}/' + data +
                                '" target="_blank" style="font-size:22px;"><em class="icon ni ni-file-pdf"></em></a>';
                        }
                    },
                    {
                        "mData": "shop_act",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ asset('storage/app/public') }}/' + data +
                                '" target="_blank" style="font-size:22px;"><em class="icon ni ni-file-pdf"></em></a>';
                        }
                    },
                    {
                        "mData": "itr",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ asset('storage/app/public') }}/' + data +
                                '" target="_blank" style="font-size:22px;"><em class="icon ni ni-file-pdf"></em></a>';
                        }
                    },
                    {
                        "mData": "gstin",
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<a href="{{ asset('storage/app/public') }}/' + data +
                                    '" target="_blank" style="font-size:22px;"><em class="icon ni ni-file-pdf"></em></a>';
                            } else {
                                return 'NA';
                            }
                        }
                    }
                ]
            });
        }

        document.getElementById('download-report').addEventListener('click', function(event) {
            event.preventDefault();

            var startDate = $("#from_date").val();
            var endDate = $("#to_date").val();

            var queryParams = new URLSearchParams();
            if (startDate) {
                queryParams.append('startDate', startDate);
            }
            if (startDate) {
                queryParams.append('endDate', endDate);
            }

            const baseURL = "{{ url('/') }}";
            const fullURL = `${baseURL}/download/business_loan_enquiry_report?${queryParams.toString()}`;
            window.location.href = fullURL;
        });
    </script>
@endsection
