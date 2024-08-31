<?php $__env->startSection('content'); ?>


<section>
    <div class="main-container container-fluid px-4 mt-5">
        <section>
            <div class="container-fluid px-4 pt-5">
                <div class="row py-5 mb-4 justify-content-center">
                    <div class="header text-center">
                        <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="kalasewa"
                            class="header-image img-fluid mx-auto mt-4 d-block">
                        <h1 class="mt-3">K A L A S E W A</h1>
                        <h4 class="text-center mb-4">Wujudkan impian cosplaymu bersama-sama!</h4>
                        <h2 class="text-center mb-5">TENTANG KALASEWA</h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="row justify-content-center">
            <div class="col-lg-14 col-md-12 mb-4 mt-2">
                <div class="card border-1 shadow-sm">
                    <div class="card-body about-us-content">
                        <p class="card-text">
                            <?php echo $aboutUs->content; ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<style>
    p {
        margin-bottom: 1rem !important;
        /* Atur jarak bawah antar paragraf */
    }
</style>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/aboutus.blade.php ENDPATH**/ ?>