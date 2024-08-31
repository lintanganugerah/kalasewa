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
                            <div class="info-saldo">
                                <h3 class="fw-bold">Informasi Keuangan</h3>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <p>Saldo Dapat Ditarik</p>
                                    <?php if($saldos): ?>
                                        <h3><strong>Rp<?php echo e(number_format($saldos->saldo, 0, '', '.')); ?></strong></h3>
                                    <?php else: ?>
                                        <h3><strong>Rp0</strong></h3>
                                    <?php endif; ?>
                                </div>
                                <div class="col-4">
                                    <p>Rekening Penarikan</p>
                                    <?php if($saldos): ?>
                                        <h3><strong><?php echo e($saldos->tujuanRekening->nama ?? '***'); ?></strong></h3>
                                        <h3><strong><?php echo e($saldos->nomor_rekening ?? ' XXXXXXXXXXX'); ?></strong></h3>
                                    <?php else: ?>
                                        <h3><strong>xxxxxxxxx</strong></h3>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('viewUbahRekening')); ?>" class="btn btn-outline-primary w-100">Ubah
                                        Tujuan Rekening</a>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="<?php echo e(route('viewTarikRekening')); ?>" class="btn btn-danger">Tarik Saldo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="info-saldo">
                                <h3 class="fw-bold mb-3">Riwayat Penarikan</h3>
                            </div>
                            <table class="table w-100" id="table-penarikan">
                                <thead>
                                    <tr>
                                        <td class="fw-bold">#</td>
                                        <td class="fw-bold">Tanggal</td>
                                        <td class="fw-bold">Jumlah</td>
                                        <td class="fw-bold">Nomor Rekening/E-Wallet</td>
                                        <td class="fw-bold">Atas Nama</td>
                                        <td class="fw-bold">Bank/E-Wallet</td>
                                        <td class="fw-bold">Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $penarikans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penarikan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($penarikan->created_at); ?></td>
                                            <td><?php echo e($penarikan->nominal); ?></td>
                                            <td><?php echo e($penarikan->nomor_rekening); ?></td>
                                            <td><?php echo e($penarikan->nama_rekening); ?></td>
                                            <td><?php echo e($penarikan->bank); ?></td>
                                            <td><?php echo e($penarikan->status); ?>

                                                <?php if($penarikan->status == 'Ditolak'): ?>
                                                    karena <?php echo e($penarikan->alasan_penolakan); ?>

                                                <?php elseif($penarikan->status == 'Selesai'): ?>
                                                    <br><a href="<?php echo e(asset($penarikan->bukti_transfer)); ?>"
                                                        target="_blank">Lihat
                                                        Bukti
                                                        Transfer</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/penyewa/penarikan/penarikan.blade.php ENDPATH**/ ?>