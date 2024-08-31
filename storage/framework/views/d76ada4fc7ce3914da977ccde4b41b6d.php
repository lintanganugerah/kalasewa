<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section style="background-color: #f6f6f6;">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Mari mulai berjualan di Kalasewa!
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">Daftar dengan email toko atau pribadi, lalu
                        lakukan registrasi! Mudah hanya dengan beberapa langkah saja.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <!-- NAVTABS -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-secondary" id="penyewa-tab" href="<?php echo e(route('registerViewPenyewa')); ?>" role="tab"
                                aria-controls="penyewa" aria-selected="false">Penyewa</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bold active" id="pemilik-sewa-tab"
                                href="<?php echo e(route('registerViewPemilikSewa')); ?>" role="tab" aria-controls="pemilik-sewa"
                                aria-selected="true">Pemilik Sewa</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pemilik-sewa" role="tabpanel"
                            aria-labelledby="pemilik-sewa-tab">
                            <!-- FORM PEMILIK SEWA -->
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <h3 class="mb-5 fw-bold ls-tight">
                                        Daftar Sebagai Penjual (Pemilik Sewa)
                                    </h3>
                                    <form action="<?php echo e(route('checkEmailPemilikSewa')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php if(session('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session('error')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                        <!-- Form -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="formPemilikEmail">Email address</label>
                                            <input type="email" id="formPemilikEmail" name="email" class="form-control"
                                                required>
                                            <div id="HELP" class="form-text fw-bolder">Masukan email aktif
                                                untuk proses verifikasi email
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="d-grid mb-5">
                                            <button type="button" class="btn btn-kalasewa" data-bs-toggle="modal"
                                                data-bs-target="#syaratdanKetentuan">Daftar</button>
                                        </div>

                                        <!-- Login -->
                                        <div class="text-center">
                                            <p>Sudah memiliki akun? <a href="<?php echo e(route('loginView')); ?>"
                                                    class="fw-bold text-dark">Klik untuk Login</a></p>
                                        </div>
                                        <div class="modal fade" id="syaratdanKetentuan" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="syaratdanKetentuanlLabel">Harap baca
                                                            syarat dan Ketentuan berikut!</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="syaratKetentuan">
                                                            <?php $__currentLoopData = $peraturans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title mb-1">
                                                                            <strong><?php echo e($peraturan->Judul); ?></strong></h4>
                                                                        <p class="card-text mb-0">
                                                                            <?php echo $peraturan->Peraturan; ?></p>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <div class="mb-3 mt-5 form-check">
                                                            <input type="checkbox" class="form-check-input fw-bolder"
                                                                id="syaratCheckbox" name="setuju_syarat_dan_ketentuan"
                                                                required>
                                                            <label class="form-check-label" for="syaratCheckbox">Saya
                                                                Setuju dengan syarat dan ketentuan yang berlaku</label>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button class="btn btn-kalasewa" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END FORM PEMILIK SEWA -->
                        </div>
                    </div>
                    <!-- END NAVTABS -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/authentication/register-pemiliksewa.blade.php ENDPATH**/ ?>