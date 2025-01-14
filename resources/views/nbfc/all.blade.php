@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">NBFC</h3>
                    <div class="nk-block-des">
                        <p>List of all nbfc</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                            <em class="icon ni ni-menu-alt-r"></em>
                        </a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt d-none d-sm-block">
                                    <a href="{{ url('nbfc/add') }}" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em>
                                        <span>Add NBFC</span>
                                    </a>
                                </li>
                                <li class="nk-block-tools-opt d-block d-sm-none">
                                    <a href="#" class="btn btn-icon btn-primary">
                                        <em class="icon ni ni-plus"></em>
                                    </a>
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
                                <th>NBFC Name</th>
                                <th>Payment Limit (₹)</th>
                                <th>Status</th>
                                <th>Action</th>
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

                ajax: "{{ url('nbfc/all') }}",
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

                "columns": [{
                        "mData": "nbfc_name"
                    },
                    {
                        "mData": "payment_limit"
                    },
                    {
                        "mData": "is_active"
                    },
                    {
                        "mData": "action"
                    }
                ]
            });
        }

        function deleteRecord(id) {
            if ($.trim(id)) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            url: "{{ url('nbfc/delete') }}/" + id,
                            type: "GET",
                            data: {
                                'id': id,
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire("Done", response.message, "success");
                                    $("#myTable").DataTable().ajax.reload();
                                    return true;
                                }

                                if (response.status == 'error') {
                                    Swal.fire("Error!", response.message, "error");
                                    return true;
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error!", "Something went wrong", "error");
                            }
                        });
                    }
                });
            }
        }

        function changeStatus(id, status) {
            if ($.trim(id)) {
                var message = "You want to active.";

                if (status == 0) {
                    message = "You want to inactive.";
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },

                            url: "{{ url('nbfc/change-status') }}",
                            type: "POST",
                            data: {
                                'id': id,
                                'status': status
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire("Done", response.message, "success");
                                    $("#myTable").DataTable().ajax.reload();
                                    return true;
                                }

                                if (response.status == 'error') {
                                    Swal.fire("Error!", response.message, "error");
                                    return true;
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error!", "Something went wrong", "error");
                            }
                        });
                    }
                });
            }
        }
    </script>
@endsection
