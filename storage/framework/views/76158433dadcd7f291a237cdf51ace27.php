<?php $__env->startSection('title', 'Pengajuan Denda'); ?>

<?php $__env->startSection('content'); ?>

<?php
    use Carbon\Carbon;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengajuan Denda</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengajuan Denda</li>
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
            <h5 class="card-title">Penalty Request</h5>
            <?php if($penaltys->isEmpty()): ?>
                <p>Sedang tidak ada pengajuan tertunda.</p>
            <?php else: ?>
                <table class="table table-bordered" id="refunds-table">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal</th>
                            <th>No Order</th>
                            <th>Toko</th>
                            <th>Nama Penyewa</th>
                            <th>Peraturan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $penaltys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penalty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo e(Carbon::parse($penalty->created_at)->translatedFormat('j F Y, H:i')); ?>

                                </td>
                                <td class="align-middle"><?php echo e($penalty->nomor_order); ?></td>
                                <td class="align-middle"><?php echo e($penalty->toko->nama_toko); ?></td>
                                <td class="align-middle"><?php echo e($penalty->penyewa->nama); ?></td>
                                <td class="align-middle"><?php echo e($penalty->peraturan->nama); ?></td>
                                <td class="align-middle">
                                    <?php if($penalty->status == 'pending'): ?>
                                        <span class="badge badge-warning"><?php echo e(ucfirst($penalty->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($penalty->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($penalty->status === 'pending'): ?>
                                        <a href="<?php echo e(route('admin.penalty.show', $penalty->id)); ?>"
                                            class="btn btn-primary btn-block">Detail</a>
                                    <?php else: ?>
                                        <p>Status tidak dikenali: <?php echo e($penalty->status); ?></p>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/penalty/index.blade.php ENDPATH**/ ?>