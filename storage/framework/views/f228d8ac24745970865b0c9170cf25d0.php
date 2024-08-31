<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">

            <div class="text-left mb-5 mt-3 ml-4">
                <!-- Tombol Back -->
                <div class="text-left mt-3 mb-3">
                    <a href="<?php echo e(route('seller.keuangan.dashboardKeuangan')); ?>" class="btn btn-outline kalasewa-color"><i
                            class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
                </div>
                <h1 class="fw-bold text-secondary">Pengaturan Rekening</h1>
                <h4 class="fw-semibold text-secondary">Inputkan Informasi Rekening Anda untuk Penarikan</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-body">
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('seller.rekening.store')); ?>" id="submitRekening" method="post">
                            <?php echo csrf_field(); ?>
                            <div class='form-group'>
                                <label for='tujuan_rek'>Bank/E-Wallet <span class='text-danger'>*</span></label>
                                <select name='tujuan_rek'
                                    class='form-control select2 <?php $__errorArgs = ['tujuan_rek'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>' required>
                                    <option value='' selected disabled>Pilih Bank/E-Wallet</option>
                                    <?php if($list_bank): ?>
                                        <?php $__currentLoopData = $list_bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($bank->id); ?>"
                                                <?php echo e(old('tujuan_rek', optional($rekening)->tujuan_rek) == $bank->id ? 'selected' : ''); ?>>
                                                <?php echo e($bank->nama); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['tujuan_rek'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger">Bank Tidak Valid / Tidak ada di pilihan</div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nomor_rekening' class='mb-2'>Nomor Rekening Bank/E-Wallet anda <span
                                        class='text-danger'>*</span></label>
                                <input type='number' name='nomor_rekening' class='form-control'
                                    placeholder="Masukan nomor rekening / E-wallet anda"
                                    value="<?php echo e(old('nomor_rekening', optional($rekening)->nomor_rekening)); ?>" required>
                                <?php $__errorArgs = ['nomor_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nama_rekening' class='mb-2'>Atas Nama <span
                                        class='text-danger'>*</span></label>
                                <input type='text' name='nama_rekening' class='form-control'
                                    placeholder="Nama di rekening / E-wallet anda"
                                    value="<?php echo e(old('nama_rekening', optional($rekening)->nama_rekening)); ?>" required>
                                <?php $__errorArgs = ['nama_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            height: $(this).data('height') ? $(this).data('height') : $(this).hasClass('h-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/pemilikSewa/iterasi3/keuangan/setRekening.blade.php ENDPATH**/ ?>