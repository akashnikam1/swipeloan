<?php if(session('error')): ?>
    <div class="alert alert-fill alert-danger alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-cross-circle"></em>
        <strong><?php echo e(session('error')); ?></strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if(session('success')): ?>
    <div class="alert alert-fill alert-success alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-check-circle"></em>
        <strong><?php echo e(session('success')); ?></strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if(session('warning')): ?>
    <div class="alert alert-fill alert-warning alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-alert-circle"></em>
        <strong><?php echo e(session('warning')); ?></strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/layouts/flash.blade.php ENDPATH**/ ?>