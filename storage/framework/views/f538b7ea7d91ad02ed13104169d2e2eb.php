<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="mb-3 pb-1">
            <span class="h1 fw-bold mb-0">Lupa Password</span>
        </div>
        <div class="card" style="border-radius: 1rem;">
            <div class="row">

                <div class="d-md-block align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form action="<?php echo e(route('ForgotPassAction')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <?php echo e($errors->first()); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(session('error')); ?>

                                </div>
                            <?php endif; ?>
                            <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Masukan Email
                            </h5>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Email</label>
                                <input type="email" id="form2Example17" class="form-control form-control-lg"
                                    name="email" required />
                            </div>

                            <div class="d-grid mb-5">
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-kalasewa btn-lg btn-block" type="submit">Reset Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/authentication/resetPassRequestEmail.blade.php ENDPATH**/ ?>