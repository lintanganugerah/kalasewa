<?php $__env->startSection('content'); ?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Reset Password</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">

                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="<?php echo e(route('resetPassAction', $token)); ?>" method="POST">
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
                                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Input Password Baru
                                </h5>
                                <div class="form-outline mb-4">
                                    <label for="validpassword" class="form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="validpassword" name="password"
                                            minlength="8" value="<?php echo e(old('password')); ?>" required>
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password"
                                            onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon"></i></button>
                                    </div>
                                    <div class="form-text">
                                        Password harus memiliki panjang 8 karakter, memiliki huruf kapital, angka, dan
                                        simbol
                                    </div>
                                    <div class="form-text error-message text-danger" id="passwordError"></div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" class="form-control error-check"
                                            name="password_confirmation" minlength="8"
                                            value="<?php echo e(old('password_confirmation')); ?>" required />
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="toggle-password-konfirmasi" onclick="konfirmasitogglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon-konfirmasi"></i></button>
                                    </div>
                                    <div class="form-text error-message text-danger" id="konfirmasi_error"></div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="password_confirmation">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(asset('seller/validasiRegisPemilik.js')); ?>"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('validpassword');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function konfirmasitogglePassword() {
            const passwordInput = document.getElementById('password_confirmation');
            const toggleIcon = document.getElementById('toggle-icon-konfirmasi');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/authentication/resetPass.blade.php ENDPATH**/ ?>