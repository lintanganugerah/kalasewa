<?php $__env->startSection('content'); ?>
<section style="background-color: #d3373a;">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/banned.css')); ?>" />
    <div class="main-containernya d-flex justify-content-center align-items-center vh-100">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col">
                    <!-- <img class="logo-kalasewa" src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="Kalasewa"> -->
                    <h1 class="display-3 fw-bold ls-tight text-light">
                        Anda telah di BANNED
                    </h1>
                    <h4 class="ls-tight text-secondary text-light">
                        Mohon maaf, Anda telah di banned dari website Kalasewa
                    </h4>
                    <div class="fw-bold kalasewa-color"><?php echo e(session('email')); ?></div>
                    <p class="fw-bold text-light">Mohon cek Email anda untuk informasi lebih lanjut</p>
                    <a href="/logout" class=" btn btn-success">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/authentication/infoBanned.blade.php ENDPATH**/ ?>