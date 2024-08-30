<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

<section style="background-color: #f6f6f6;">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Selamat Datang
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">Ayo mulai Wujudkan impian cosplaymu bersama Kalasewa!
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="<?php echo e(route('loginAction')); ?>" method="POST">
                                <h1 class="mb-5 fw-bold ls-tight">
                                    Login
                                </h1>
                                <?php echo csrf_field(); ?>
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

                                <!-- Email input -->
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                </div>

                                <!-- Password input -->
                                <div class="mb-3">
                                    <label for="pass" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password"
                                            onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-end mb-4">
                                    <a class="form-check-label text-reset" href="<?php echo e(route('viewForgotPass')); ?>"
                                        for="form2Example33">
                                        Lupa password?
                                    </a>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mb-5">
                                    <button class="btn btn-kalasewa" type="submit">Masuk</button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Belum memiliki akun?
                                        <a href="<?php echo e(route('registerViewPenyewa')); ?>" class="fw-bold text-dark">Klik
                                            untuk daftar</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</Section>
<!-- Add Bootstrap JS and jQuery scripts here -->
<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
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
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/authentication/login.blade.php ENDPATH**/ ?>