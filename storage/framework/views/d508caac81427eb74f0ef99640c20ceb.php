<?php $__env->startSection('content'); ?>
    <section>

        <div class="container-fluid">
            <div class="container">
                <div class="header-text text-center mt-5">
                    <h1><strong>Penarikan Saldo</strong></h1>
                </div>

                <div class="alert-content mt-2">
                    <?php echo csrf_field(); ?>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-penarikan mt-3">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?php echo e(route('tarikSaldo')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="nominal-tarik">
                                    <label for="exampleInputEmail1" class="form-label">Nominal<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" class="form-control form-control-lg" name="nominal" placeholder="Nominal" aria-label="Nominal"
                                            aria-describedby="basic-addon1" value="<?php echo e($saldos->saldo ?? 0); ?>" disabled>
                                    </div>
                                    <div id="emailHelp" class="form-text">Nominal yang dapat anda tarik</div>
                                </div>

                                <div class="tujuang-rekening mt-3">
                                    <label for="exampleInputEmail1" class="form-label">Tujuang Rekening<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"
                                        name="tujuan_rekening" value="<?php echo e($saldos->TujuanRekening->nama); ?> | <?php echo e($saldos->nomor_rekening); ?> | <?php echo e($saldos->nama_rekening); ?>" disabled>
                                    <div id="emailHelp" class="form-text">Pastikan nomor rekening/e-wallet benar. Ingin
                                        mengubah tujuan transfer? <a href="<?php echo e(route('viewUbahRekening')); ?>" class="text-danger">Klik disini</a></div>
                                </div>

                                <div class="aksi-btn d-flex gap-3 mt-3">
                                    <a href="<?php echo e(route('viewPenarikan')); ?>" class="btn btn-danger w-100">Batal</a>
                                    <button type="submit" class="btn btn-primary w-100">Tarik Saldo</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/penarikan/tarikRekening.blade.php ENDPATH**/ ?>