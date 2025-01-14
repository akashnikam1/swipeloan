<?php $__env->startSection('content'); ?>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Credit Report Transaction</h3>
                    <div class="nk-block-des">
                        <p>List of all credit report transactions</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                            <em class="icon ni ni-menu-alt-r"></em>
                        </a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt d-block d-sm-none">
                                    <a href="#" class="btn btn-icon btn-primary">
                                        <em class="icon ni ni-plus"></em>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content"></div>
                        <div class="nk-block-head-content col-lg-11">
                            <ul class="nk-block-tools g-2 col-lg-12">
                                <li class="col-lg-3" style="width: 160px;">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-ui="lg" data-search="on" name="user_id" id="user_id">
                                                <option value="select_user_id" selected disabled>Select User</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>">
                                                        <?php echo e($user->first_name && $user->last_name ? $user->first_name . ' ' . $user->last_name . ' - ' . $user->phone_number : $user->phone_number); ?>

                                                    </option>                                                
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-4">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                class="form-control form-control-lg form-control-outlined date-picker <?php $__errorArgs = ['from_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                value="" name="from_date" id="from_date">
                                            <label class="form-label-outlined" for="from_date">From Date</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-lg-4">
                                    <div class="form-group col-lg-12">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right" style="margin-top: 2px; pointer-events:none;">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                class="form-control form-control-lg form-control-outlined date-picker <?php $__errorArgs = ['to_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
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
                                <th>Transaction Id</th>
                                <th>Name</th>
                                <th>Payment Amount</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
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

        $('#user_id').change(function() {
            $("#myTable").DataTable().clear().destroy();
            datatable1();
        });

        function datatable1() {
            from_date = $("#from_date").val();
            to_date = $("#to_date").val();
            user_id = $("#user_id").val();

            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                ajax: "<?php echo e(url('credit_report_transactions/all')); ?>?from_date=" + from_date + "&to_date=" + to_date + "&user_id=" + user_id,
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
                        "mData": "transaction_id",
                        "mRender": function(data, type, row) {
                            if (row.transaction_id != null) {
                                var truncatedText = data.length > 10 ? data.substr(0, 10) + '...' : data;
                                return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    row.transaction_id + "' data-placement='top'>" + truncatedText + "</span>";
                            } else {
                                return "NA";
                            }
                        },
                    },
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
                        "mData": "payment_amount"
                    },
                    {
                        data: 'payment_date',
                        render: function(data, type, row) {
                            var date = new Date(data);
                            var day = ('0' + date.getDate()).slice(-2);
                            var month = ('0' + (date.getMonth() + 1)).slice(-2);
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "status",
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return "<h6 class='text-success sub-text' style='margin-top:2px;'>Completed</h6>";
                            } else {
                                return "<h6 class='text-primary sub-text' style='margin-top:2px;'>Pending</h6>";
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
            var userId = $("#user_id").val();

            var queryParams = new URLSearchParams();
            if (userId) {
                queryParams.append('userId', userId);
            }
            if (startDate) {
                queryParams.append('startDate', startDate);
            }
            if (startDate) {
                queryParams.append('endDate', endDate);
            }

            const baseURL = "<?php echo e(url('/')); ?>";
            const fullURL = `${baseURL}/download/credit_report_transaction?${queryParams.toString()}`;
            window.location.href = fullURL;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/credit_report_transactions/all.blade.php ENDPATH**/ ?>