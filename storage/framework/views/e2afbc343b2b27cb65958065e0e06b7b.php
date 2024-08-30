<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/wishlist.css')); ?>" />

<section>
    <div class="main-container container-fluid px-4">
        <section>
            <div class="container-fluid px-4">
                <div class="row py-5 mb-4 justify-content-center">
                    <div class="header text-center">
                        <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="kalasewa"
                            class="header-image img-fluid mx-auto d-block">
                        <h1 class="mt-3">K A L A S E W A</h1>
                        <h4 class="text-center mb-4">Wujudkan impian cosplaymu bersama-sama!</h4>
                        <h2 class="text-center mb-5">REGULASI KALASEWA</h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="row justify-content-center">
            <?php $__currentLoopData = $peraturans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-14 col-md-12 mb-4">
                    <div class="card border-1 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><strong><?php echo e($peraturan->Judul); ?></strong></h4>
                            <p class="card-text"><?php echo $peraturan->Peraturan; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/rules.blade.php ENDPATH**/ ?>