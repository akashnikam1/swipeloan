@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">User Notification</h3>
                    <div class="nk-block-des">
                        <p>List of all user notifications</p>
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
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Title</th>
                                <th width="30%">Description</th>
                                <th>Sent Date</th>
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
                ajax: "{{ url('user_notifications/all') }}",
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
                        "mData": "image",
                        "mRender": function(data, type, row) {
                             if (row.image) {
                                var imageUrl = '{{ asset('storage/app/public/') }}' + '/' + row.image;
                                return '<img src="' + imageUrl + '" style="width: 60px; height: 60px;">';
                            } else {
                                var imageUrl = '{{ asset('assets/images/default-image.jpeg') }}';
                                return '<img src="' + imageUrl + '" style="width: 60px; height: 60px;">';
                            }
                        }
                    },
                    {
                        "mData": 'users.first_name',
                        render: function(data, type, row) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": 'users.last_name',
                        render: function(data, type, row) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": "title"
                    },
                    {
                        "mData": "description",
                        "mRender": function(data, type, row) {
                            if (row.description) {
                                var truncatedText = data.length > 35 ? data.substr(0, 35) + '...' : data;
                                return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    row.description + "' data-placement='top'>" + truncatedText + "</span>";
                            } else {
                                return "NA";
                            }
                        },
                    },
                    {
                        "mData": "created_at",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:mm:ss');
                        }
                    },
                ]
            });
        }
    </script>
@endsection
