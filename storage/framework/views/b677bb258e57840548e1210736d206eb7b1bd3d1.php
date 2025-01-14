<?php $__env->startSection('style'); ?>
    <style>
        .row .card {
            border-radius: 12px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Business Enquiry Statistics</h3>
                    <div class="nk-block-des">
                        <p>Welcome to business enquiry statistics</p>
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
                    <ul class="nk-block-tools g-3">
                        <li>
                            <div class="form-group">
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
                        <li>
                            <div class="form-group">
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
                    </ul>
                </div>
            </div>
        </div>

        <div class="nk-block mt-3">
            <div class="row g-gs">
                <div class="col-sm-4">
                    <div class="card card-full" style="background-color: #4DA1A1">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0 text-white">
                                    <h6 class="title">Clicks</h6>
                                </div>
                            </div>
                            <h5 id="total_clicks" class="fs-1 text-white"><?php echo e($totalClickCount); ?></h5>
                            <div class="fs-7 text-white text-opacity-75 mt-1">Total Clicks</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-full" style="background-color: #7A65EA">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="card-title mb-0 text-white">
                                    <h6 class="title">Users</h6>
                                </div>
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li class="">
                                            <a href="<?php echo e(url('users/all')); ?>" class="link link-white">
                                                <span>See History</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 id="total_users" class="fs-1 text-white"><?php echo e($totalUserCount); ?></h5>
                            <div class="fs-7 text-white text-opacity-75 mt-1">Total Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Phone Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date</th>
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

                ajax: "<?php echo e(url('business_enquiry_statistics/all')); ?>?from_date=" + from_date + "&to_date=" + to_date,
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
                        "targets": -1,
                        "mData": "phone_number",
                        "render": function(data, type, row) {
                            return data ? '<a href="<?php echo e(url('users/user_details')); ?>/' + row.id +
                                '"><span>' + data + '</span></a>' :
                                '<a href="<?php echo e(url('users/user_details')); ?>/' + row.id +
                                '"><span>NA</span></a>';
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "first_name",
                        "render": function(data, type, row) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "targets": -1,
                        "mData": "last_name",
                        "render": function(data, type, row) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": "click_date",
                        "render": function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    }
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var totalClickCount = settings.json.totalClickCount;
                    var totalUserCount = settings.json.totalUserCount;

                    $('#total_clicks').text(totalClickCount);
                    $('#total_users').text(totalUserCount);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/business_enquiry_statistics/all.blade.php ENDPATH**/ ?>