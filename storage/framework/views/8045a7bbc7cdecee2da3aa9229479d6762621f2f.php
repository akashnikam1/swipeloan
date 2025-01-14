<?php $__env->startSection('content'); ?>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Users</h3>
                    <div class="nk-block-des">
                        <p>List of all users</p>
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
                <div class="nk-block-head-content col-lg-4">
                    <ul class="nk-block-tools g-3">
                        <li class="col-lg-9">
                            <div class="form-group col-lg-12">
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" data-ui="lg" data-search="on" name="loan_status" id="loan_status">
                                        <option value="select_loan_status" selected disabled>Select Loan Status</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Active</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-3">
                            <button style="padding:10px 25px;" type="button" id="download-report" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Report">
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
                                <th>Phone Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th class="text-center">Notification Status</th>
                                <th>Loan Status</th>
                                <th>CIBIL Status</th>
                                <th>Status</th>
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

        $('#loan_status').change(function() {
            $("#myTable").DataTable().clear().destroy();
            datatable1();
        });

        function datatable1() {
            loan_status = $("#loan_status").val();

            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: "<?php echo e(url('users/all')); ?>?loan_status=" + loan_status,
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
                        "mData": "phone_number",
                        render: function(data, type, row) {
                            if(row.phone_number) {
                                return '<a href="<?php echo e(url('users/user_details')); ?>/' + row.id + '"><span>' + data + '</span></a>';
                            } else {
                                return '<a href="<?php echo e(url('users/user_details')); ?>/' + row.id + '"><span>NA</span></a>';
                            }
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "first_name",
                        "mRender": function(data, type, row) {
                            if (row.first_name) {
                                return row.first_name;
                            } else {
                                return 'NA';
                            }
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "last_name",
                        "mRender": function(data, type, row) {
                            if (row.last_name) {
                                return row.last_name;
                            } else {
                                return 'NA';
                            }
                        }
                    },
                    {
                        targets: -1,
                        mData: "is_notification",
                        render: function (data, type, row) {
                            const checked = row.is_notification == 1 ? 'checked' : '';
                            return `
                                <div class="custom-control-sm text-center custom-switch" style="margin-top: 2px;">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch${row.id}" ${checked} onclick="changeNotificationStatus(${row.id}, this)">
                                    <label class="custom-control-label" for="customSwitch${row.id}"></label>
                                </div>`;
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "loan_status",
                        render: function(data, type, row) {
                            if (row.loan_status == 2) {
                                return "<h6 class='text-success sub-text' style='margin-top:5px;'>Active</h6>";
                            } else if (row.loan_status == 1){
                                return "<h6 class='text-info sub-text' style='margin-top:5px;'>Applied</h6>";
                            } else {
                                return "<h6 class='text-danger sub-text' style='margin-top:5px;'>Inactive</h6>";
                            }
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "cibil_status",
                        render: function(data, type, row) {
                            if (row.cibil_status == 1) {
                                return "<h6 class='text-success sub-text' style='margin-top:5px;'>Active</h6>";
                            } else {
                                return "<h6 class='text-danger sub-text' style='margin-top:5px;'>Inactive</h6>";
                            }
                        }
                    },
                    {
                        "mData": "is_active"
                    },
                ]
            });
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
                                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                            },

                            url: "<?php echo e(url('users/change-status')); ?>",
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

        function changeNotificationStatus(id, checkbox) {
            if ($.trim(id)) {
                var status = checkbox.checked ? 1 : 0;
                var message = "You want to enable.";

                if (status == 0) {
                    message = "You want to disable.";
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                    },

                    url: "<?php echo e(url('users/change-notification-status')); ?>",
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
        }
        
        document.getElementById('download-report').addEventListener('click', function(event) {
            event.preventDefault();

            var loanStatus = $("#loan_status").val();

            var queryParams = new URLSearchParams();
            if (loanStatus) {
                queryParams.append('loanStatus', loanStatus);
            }

            const baseURL = "<?php echo e(url('/')); ?>";
            const fullURL = `${baseURL}/download/user_report?${queryParams.toString()}`;

            window.location.href = fullURL;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/users/all.blade.php ENDPATH**/ ?>