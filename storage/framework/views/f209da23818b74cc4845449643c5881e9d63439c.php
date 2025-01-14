<?php $__env->startSection('content'); ?>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Edit General Setting</h3>
                    <div class="nk-block-des">
                        <p>Update general setting details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="<?php echo e(url('general_settings/edit')); ?>/<?php echo e($data->id); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="referral_amount">Referral Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg <?php $__errorArgs = ['referral_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="referral_amount" id="referral_amount" value="<?php echo e(old('referral_amount', $data->referral_amount)); ?>" placeholder="Referral Amount">
                                        <?php $__errorArgs = ['referral_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="credit_report_amount">Credit Report Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg <?php $__errorArgs = ['credit_report_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="credit_report_amount" id="credit_report_amount" value="<?php echo e(old('credit_report_amount', $data->credit_report_amount)); ?>" placeholder="Credit Report Amount">
                                        <?php $__errorArgs = ['credit_report_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="payment_mode">Payment Mode</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-ui="lg" data-search="on" name="payment_mode" id="payment_mode">
                                            <option value="select_payment_mode" selected disabled>Select Payment Mode</option>
                                            <option <?php echo e(( old('payment_mode', $data->payment_mode) == 1) ? 'selected' : ''); ?> value="1">Razorpay</option>
                                            <option <?php echo e(( old('payment_mode', $data->payment_mode) == 2) ? 'selected' : ''); ?> value="2">Billdesk</option>
                                        </select>
                                        <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="home_screen_video_link">Home Screen Video Link</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg <?php $__errorArgs = ['home_screen_video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="home_screen_video_link" id="home_screen_video_link" value="<?php echo e(old('home_screen_video_link', $data->home_screen_video_link)); ?>" placeholder="Home Screen Video Link">
                                        <?php $__errorArgs = ['home_screen_video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="version">Version</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg <?php $__errorArgs = ['version'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="version" id="version" value="<?php echo e(old('version', $data->version)); ?>" placeholder="Version">
                                        <?php $__errorArgs = ['version'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 d-flex justify-content-start">
                               <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="is_force_update" value="0">
                                            <input type="checkbox" class="custom-control-input" name="is_force_update"
                                                id="is_force_update" value="1" <?php echo e($data->is_force_update == 1 ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="is_force_update"><strong>Force Update</strong></label>
                                        </div>
                                    </div>
                               </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="pincode_note" value="0">
                                            <input type="checkbox" class="custom-control-input" name="pincode_note"
                                                id="pincode_note" value="1" <?php echo e($data->pincode_note == 1 ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="pincode_note"><strong>Pincode Note</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/general_settings/edit.blade.php ENDPATH**/ ?>