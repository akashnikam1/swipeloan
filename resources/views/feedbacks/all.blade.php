@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Feedback</h3>
                    <div class="nk-block-des">
                        <p>List of all feedbacks</p>
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
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rating</th>
                                <th width="65%">Description</th>
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

        function datatable1() {
            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                ajax: "{{ url('user_feedbacks/all') }}",
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
                        render: function(data, type, row, meta) {
                            if (row.users.last_name != null) {
                                return data + ' ' + row.users.last_name;
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        "mData": "rating"
                    },
                    {
                        "mData": "description",
                        "mRender": function(data, type, row) {
                            if (row.description) {
                                var truncatedText = data.length > 100 ? data.substr(0, 100) + '...' : data;
                                return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    row.description + "' data-placement='top'>" + truncatedText + "</span>";
                            } else {
                                return "NA";
                            }
                        },
                    },
                ]
            });
        }
    </script>
@endsection
