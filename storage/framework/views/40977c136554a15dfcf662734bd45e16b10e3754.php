<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="swipeloan">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwipeLoan – Approved Personal Loan in Just 2 Minutes</title>
    <link rel="icon" href="<?php echo e(asset('assets/images/favicons/cropped-swipefund_logo-32x32.png')); ?>" sizes="32x32">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicons/cropped-swipefund_logo-192x192.png')); ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo e(asset('assets/images/favicons/cropped-swipefund_logo-190x180.png')); ?>">
    <meta name="msapplication-TileImage" content="<?php echo e(asset('assets/images/favicons/cropped-swipefund_logo-270x270.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashlite.css?ver=2.7.0')); ?>">
    <link id="skin-default" rel="stylesheet" href="<?php echo e(asset('assets/css/theme.css?ver=2.7.0')); ?>">
    <style>
        .logo-img {
            max-height: 60px;
        }
    </style>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <span class="logo-link">
                            </span>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="brand-logo pb-4 text-center">
                                    <img class="logo-img" src="<?php echo e(asset('assets/images/app_logo.png')); ?>" srcset="<?php echo e(asset('assets/images/app_logo.png')); ?>" alt="logo">
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title" style="text-align:center;">Login</h4>
                                    </div>
                                </div>
                                <form action="<?php echo e(route('login')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01"><?php echo e(__('Email Address')); ?></label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input name="email" type="text" placeholder="Email Address"
                                                id="default-01"
                                                class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                value="<?php echo e(old('email')); ?>">
                                            <?php $__errorArgs = ['email'];
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
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password"><?php echo e(__('Password')); ?></label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye"></em>
                                            </a>
                                            <input id="password" name="password" type="password" placeholder="Password"
                                                class="form-control form-control-lg lock-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['password'];
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
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('assets/js/bundle.js?ver=2.7.0')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/scripts.js?ver=2.7.0')); ?>"></script>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/auth/login.blade.php ENDPATH**/ ?>