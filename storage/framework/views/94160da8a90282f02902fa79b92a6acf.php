<?php $__env->startSection('title', 'Detail Pengajuan Denda'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Pengajuan Denda</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengajuan Denda</li>
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

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php echo e($errors->first()); ?>

    </div>
<?php endif; ?>

<?php
    use Carbon\Carbon;
?>

<div class="card mb-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo e(Carbon::parse($penalty->created_at)->translatedFormat('j F Y, H:i')); ?></td>
                </tr>
                <tr>
                    <th>No Order</th>
                    <td><?php echo e($penalty->nomor_order); ?></td>
                </tr>
                <tr>
                    <th>Nama Toko</th>
                    <td><?php echo e($penalty->toko->nama_toko); ?> (<?php echo e($penalty->toko->user->no_telp); ?>)</td>
                </tr>
                <tr>
                    <th>Nama Penyewa</th>
                    <td><?php echo e($penalty->penyewa->nama); ?> (<?php echo e($penalty->penyewa->no_telp); ?>)</td>
                </tr>
                <tr>
                    <th>Peraturan</th>
                    <td><?php echo e($penalty->peraturan->nama); ?></td>
                </tr>
                <tr>
                    <th>Penjelasan</th>
                    <td><?php echo e($penalty->penjelasan); ?></td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>Rp. <?php echo e(number_format($penalty->nominal_denda, 0, '', '.')); ?></td>
                </tr>
                <tr>
                    <th>Foto Bukti</th>
                    <td>
                        <?php if($penalty->foto_bukti): ?>
                            <?php if($penalty->foto_bukti): ?>
                                <?php $__currentLoopData = $penalty->foto_bukti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(asset($foto)); ?>" target="_blank">Lihat Bukti Foto[<?php echo e($loop->iteration); ?>]<br></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p> Tidak ada Bukti Foto </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <form action="<?php echo e(route('admin.penalty.confirm', $penalty->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="penalty_id" value="<?php echo e($penalty->id); ?>">
                <button type="submit" class="btn btn-primary mt-2 btn-block">Konfirmasi</button>
            </form>
            <form action="<?php echo e(route('admin.penalty.hitnrun', $penalty->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="penalty_id" value="<?php echo e($penalty->id); ?>">
                <button type="submit" class="btn btn-warning mt-2 btn-block">Penyewa Kabur</button>
            </form>
            <div class="mb-2 mt-2">
                <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                    data-target="#rejectModal">Tolak</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Alasan Penolakan -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.penalty.reject', $penalty->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="alasan_penolakan">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\kalasewa hosting iterasi 3 v1\resources\views/admin/penalty/show.blade.php ENDPATH**/ ?>