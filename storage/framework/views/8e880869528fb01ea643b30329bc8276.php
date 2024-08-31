<?php $__env->startSection('title', 'Pengajuan Retur'); ?>

<?php $__env->startSection('content'); ?>

<?php
    use Carbon\Carbon;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengajuan Retur</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengajuan Retur</li>
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
            <h5 class="card-title">Return Request</h5>
            <?php if($returs->isEmpty()): ?>
                <p>Sedang tidak ada permintaan pengajuan tertunda.</p>
            <?php else: ?>
                <table class="table table-bordered" id="orders-table">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 180px">Tanggal</th>
                            <th>No Order</th>
                            <th>Nama Penyewa</th>
                            <th>Toko</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $__currentLoopData = $returs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle"><?php echo e(Carbon::parse($retur->created_at)->translatedFormat('j F Y')); ?></td>
                                <td class="align-middle"><?php echo e($retur->nomor_order); ?></td>
                                <td class="align-middle"><?php echo e($retur->penyewa->nama); ?></td>
                                <td class="align-middle"><?php echo e($retur->produk->toko->nama_toko); ?></td>
                                <td class="align-middle">
                                    <?php if($retur->status == 'Pending'): ?>
                                        <span class="badge badge-danger"><?php echo e(ucfirst($retur->status)); ?></span>
                                    <?php elseif($retur->status == 'Retur'): ?>
                                        <span class="badge badge-warning"><?php echo e(ucfirst($retur->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($retur->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                        data-target="#returModal-<?php echo e($retur->nomor_order); ?>">Tampilkan</button>
                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="returModal-<?php echo e($retur->nomor_order); ?>" tabindex="-1" role="dialog"
                    aria-labelledby="returModalLabel-<?php echo e($retur->nomor_order); ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="returModalLabel-<?php echo e($retur->nomor_order); ?>">
                                    Detail Retur
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Nomor Order</th>
                                                <td><?php echo e($retur->nomor_order); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pengajuan</th>
                                                <td><?php echo e(Carbon::parse($retur->updated_at)->translatedFormat('j F Y')); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama Penyewa</th>
                                                <td><?php echo e($retur->penyewa->nama); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Penyewa</th>
                                                <td><?php echo e($retur->user->no_telp); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Toko</th>
                                                <td><?php echo e($retur->produk->toko->nama_toko); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Toko</th>
                                                <td><?php echo e($retur->toko->user->no_telp); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="<?php echo e(route('admin.retur.complete', $retur->nomor_order)); ?>" method="POST"
                                    class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                </form>
                                <a href="<?php echo e(route('admin.retur.reject', ['nomor_order' => $retur->nomor_order])); ?>"
                                    class="btn btn-danger">Tolak</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/retur/index.blade.php ENDPATH**/ ?>