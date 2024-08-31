<?php $__env->startSection('title', 'Manajemen Dana'); ?>

<?php $__env->startSection('content'); ?>

<?php
    use Carbon\Carbon;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Dana</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen Dana</li>
    </ol>
</div>

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

<div class="card mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <h5 class="card-title">Refund & Withdraw Request</h5>
            <?php if($refunds->isEmpty()): ?>
                <p>Sedang tidak ada permintaan pengembalian dana tertunda.</p>
            <?php else: ?>
                <table class="table table-bordered" id="refunds-table">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 180px">Tanggal</th>
                            <th>Nama</th>
                            <th style="width: 100px">Nominal</th>
                            <th style="width: 310px">Bank</th>
                            <th style="width: 100px">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle"><?php echo e(Carbon::parse($refund->created_at)->translatedFormat('j F Y')); ?>

                                </td>
                                <td class="align-middle"><?php echo e($refund->user->nama); ?></td>
                                <td class="align-middle"><?php echo e(number_format($refund->nominal, 2, ',', '.')); ?></td>
                                <td class="align-middle"><?php echo e($refund->bank); ?></td>
                                <td class="align-middle">
                                    <?php if($refund->status == 'Menunggu Konfirmasi'): ?>
                                        <span class="badge badge-primary"><?php echo e(ucfirst($refund->status)); ?></span>
                                    <?php elseif($refund->status == 'Sedang Diproses'): ?>
                                        <span class="badge badge-warning"><?php echo e(ucfirst($refund->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($refund->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($refund->status === 'Menunggu Konfirmasi'): ?>
                                        <form action="<?php echo e(route('admin.refunds.process')); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="refund_id" value="<?php echo e($refund->id); ?>">
                                            <button type="submit" class="btn btn-primary btn-block">Proses</button>
                                        </form>
                                    <?php elseif($refund->status === 'Sedang Diproses'): ?>
                                        <a href="<?php echo e(route('admin.refunds.show', ['id' => $refund->id])); ?>"
                                            class="btn btn-success btn-block">Transfer</a>
                                    <?php else: ?>
                                        <p>Status tidak dikenali: <?php echo e($refund->status); ?></p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <h5 class="card-title">History</h5>
            <?php if($refundsHistory->isEmpty()): ?>
                <p>Belum ada pengembalian dana.</p>
            <?php else: ?>
                <table class="table table-bordered" id="refunds-table">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 180px">Dibuat</th>
                            <th>Nama</th>
                            <th style="width: 100px">Nominal</th>
                            <th style="width: 304px">Bank</th>
                            <th style="width: 100px">Status</th>
                            <th style="text-align: center; width: 14%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $refundsHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle"><?php echo e(Carbon::parse($refund->created_at)->translatedFormat('j F Y')); ?>

                                </td>
                                <td class="align-middle"><?php echo e($refund->user->nama); ?></td>
                                <td class="align-middle"><?php echo e(number_format($refund->nominal, 2, ',', '.')); ?></td>
                                <td class="align-middle"><?php echo e($refund->bank); ?></td>
                                <td class="align-middle">
                                    <?php if($refund->status === 'Selesai'): ?>
                                        <span class="badge badge-success"><?php echo e(ucfirst($refund->status)); ?></span>
                                    <?php elseif($refund->status === 'Ditolak'): ?>
                                        <span class="badge badge-danger"><?php echo e(ucfirst($refund->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($refund->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($refund->status === 'Selesai' || $refund->status === 'Ditolak'): ?>
                                        <a href="<?php echo e(route('admin.refunds.show', ['id' => $refund->id])); ?>"
                                            class="btn btn-info btn-block">Lihat Detail</a>
                                    <?php else: ?>
                                        <p>Status tidak dikenali: <?php echo e($refund->status); ?></p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div style="display: flex; justify-content: center; margin: 20px 0;">
                    <?php echo e($refundsHistory->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/admin/refunds/index.blade.php ENDPATH**/ ?>