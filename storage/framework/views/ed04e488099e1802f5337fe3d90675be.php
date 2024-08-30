<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <a href="<?php echo e(route('seller.keuangan.dashboardKeuangan')); ?>" class="btn btn-outline-danger">Kembali</a>
            <div class="d-flex justify-content-between mb-5 mt-3">
                <div>
                    <h1 class="fw-bold text-secondary">Tarik Saldo</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('seller.penarikan-saldo.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class='form-group mb-3'>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" class="form-control" placeholder="Minimal Rp. 10.000" id="nominal"
                                    aria-describedby="basic-addon1" name="nominal" min="10000"
                                    max="<?php echo e(auth()->user()->saldo_user->saldo); ?>" value="<?php echo e(old('nominal')); ?>"required>
                            </div>
                            <?php $__errorArgs = ['nominal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-text text-danger mb-3" id="nominalError"></div>
                        </div>
                        <div class="form-group form-check ml-1">
                            <input type="checkbox" class="form-check-input" id="semua"
                                value="<?php echo e(auth()->user()->saldo_user->saldo); ?>" onchange="checkSemua(this)">
                            <label class="form-check-label" for="semua">Tarik Semua Saldo (Rp.
                                <?php echo e(number_format(auth()->user()->saldo_user->saldo, 0, ',', '.')); ?>)</label>
                        </div>
                        <div class='form-group mb-3'>
                            <label for='' class='mb-2'>Transfer Tujuan<span class='text-danger'>*</span></label>
                            <input type='text'
                                placeholder="<?php echo e(auth()->user()->saldo_user->tujuanRekening->nama); ?> | Atas Nama <?php echo e(auth()->user()->saldo_user->nama_rekening); ?> | <?php echo e(auth()->user()->saldo_user->nomor_rekening); ?>"
                                class='form-control' disabled>
                            <?php $__errorArgs = ['bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger">Tujuan Transfer Ditemukan. Harap set tujuan transfer anda.</div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <p>Pastikan nomor rekening/e-wallet benar. Ingin mengubah tujuan transfer? <a
                                href="<?php echo e(route('seller.rekening.viewSetRekening')); ?>" class="text-danger">Klik disini</a>
                        </p>
                        <div class="form-group">
                            <button type="button" class="btn btnTarik btn-danger btn-block">Ajukan Penarikan Penghasilan
                                (Withdraw)</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalOTP" tabindex="-1" aria-labelledby="modalOTPpenarikan"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalOTPpenarikan">Masukan Kode OTP</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class='form-group mb-3'>
                                            <label for='kode_otp' class='mb-2'>Kode OTP<span
                                                    class='text-danger'>*</span></label>
                                            <input type='text' name='kode_otp' id='modal_kode_otp'
                                                class='form-control <?php $__errorArgs = ['kode_otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>'
                                                placeholder="Masukan kode OTP yang telah dikirim" required>
                                        </div>
                                        <div class="mb-3 info">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="requestOtpButton">Request
                                                Kode OTP
                                                Lagi <span id="otpTimer"></span></button>
                                            <button type="button" onclick="submit()" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
            <meta name="ajax-url" content="<?php echo e(route('seller.kodeOTPpenarikan.send')); ?>">
            <meta name="email" content="<?php echo e(auth()->user()->email); ?>">
        </div>
    </div>
    <script src="<?php echo e(asset('seller/createPenarikan.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi3/penarikan/create.blade.php ENDPATH**/ ?>