<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3 ml-4">
                <!-- Tombol Back -->
                <div class="text-left mt-3 mb-4">
                    <a href="<?php echo e(route('seller.profil.viewAlamatTambahanToko')); ?>" class="btn btn-outline kalasewa-color"><i
                            class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
                </div>
                <h1 class="fw-bold text-secondary">Edit Alamat</h1>
                <h4 class="fw-semibold text-secondary">Anda akan melakukan edit informasi alamat</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profil" role="tabpanel"
                                aria-labelledby="profil-tab">
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
                                <form action="<?php echo e(route('seller.profil.EditAlamatTambahanAction', $at->id)); ?>" method="POST"
                                    id="formToko" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="fw-bolder fs-5 mb-3">Informasi Alamat</div>
                                    <div class="mb-3">
                                        <label for="alamatName">Nama Alamat</label>
                                        <input type="text" class="form-control error-check" id="alamatName"
                                            name="alamatNameTambahan"
                                            <?php $__errorArgs = ['alamatNameTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            value="<?php echo e(old('alamatNameTambahan', $at->nama)); ?>" required>
                                        <?php $__errorArgs = ['alamatNameTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text error-message" data-milik="alamatNameTambahan">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small id="helpNama" class="form-text text-muted mb-3">Masukkan nama alamat yang
                                            Anda ingat. Misal: Rumah/Kantor/Rumah Budi</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control error-check" id="alamatIsi" rows="5" name="alamatTambahan"
                                            <?php $__errorArgs = ['alamatTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> required><?php echo e(old('alamatTambahan', $at->alamat)); ?></textarea>
                                        <?php $__errorArgs = ['alamatTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text error-message" data-milik="alamatTambahan">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="provinsiTambahan" class="form-label">Provinsi<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select error-check" id="floatingSelect" name="provinsiTambahan"
                                            aria-label="Floating select example"
                                            <?php $__errorArgs = ['provinsiTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> required>
                                            <option value="Jawa Barat"
                                                <?php echo e(old('provinsiTambahan', $at->provinsi) == 'Jawa Barat' ? 'selected' : ''); ?>>
                                                Jawa Barat</option>
                                        </select>
                                        <?php $__errorArgs = ['provinsiTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text error-message" data-milik="provinsiTambahan">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kotaTambahan" class="form-label">Kota/Kabupaten<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select error-check" id="kotaSelect" name="kotaTambahan"
                                            <?php $__errorArgs = ['kotaTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> required>
                                            <option value="Kota Bandung"
                                                <?php echo e(old('kotaTambahan', $at->kota) == 'Kota Bandung' ? 'selected' : ''); ?>>
                                                Kota Bandung</option>
                                            <option value="Kabupaten Bandung"
                                                <?php echo e(old('kotaTambahan', $at->kota) == 'Kabupaten Bandung' ? 'selected' : ''); ?>>
                                                Kabupaten Bandung</option>
                                        </select>
                                        <?php $__errorArgs = ['kotaTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text error-message" data-milik="kotaTambahan">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    

                                    <div class="mb-3">
                                        <label class="form-label" for="kodePos">Kode Pos<span
                                                class="text-danger">*</span></label>
                                            
                                        <select class="form-select select2" id="kodePos" name="kodePosTambahan"
                                            pattern="[0-9]*" id="kodePos" minlength="5"
                                            <?php $__errorArgs = ['kodePosTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> maxlength="5" data-kodePos="<?php echo e(old('kodePosTambahan', $at->kode_pos)); ?>" required>
                                        </select>
                                        <div class="form-text error-message text-danger" id="kodePosError"></div>
                                        <?php $__errorArgs = ['kodePosTambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text error-message" data-milik="kodePosTambahan">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="d-grid my-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Tambah
                                            Alamat</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('seller/validasiProfilToko.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/kode_pos.js')); ?>"></script>
    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            height: $(this).data('height') ? $(this).data('height') : $(this).hasClass('h-100') ? '100%' : 'style',
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/alamat_tambahan/edit_alamatTambahanToko.blade.php ENDPATH**/ ?>