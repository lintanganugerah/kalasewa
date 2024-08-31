<?php $__env->startSection('title', 'Detail Ticket'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Ticket</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.ticket.index')); ?>">Manajemen Ticket</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Ticket</li>
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
            <table class="table table-bordered">
                <tr>
                    <th>Nomor Tiket</th>
                    <td><?php echo e($ticket->id); ?></td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td><?php echo e(\Carbon\Carbon::parse($ticket->created_at)->translatedFormat('j F Y, H:i')); ?></td>
                </tr>
                <tr>
                    <th>
                        <?php if($ticket->status == 'Selesai' || $ticket->status == 'Ditolak'): ?>
                            Diselesaikan Tanggal
                        <?php else: ?>
                            Diproses Tanggal
                        <?php endif; ?>
                    </th>
                    <td>
                        <?php if($ticket->status == 'Menunggu Konfirmasi'): ?>
                            <strong style="color: red;">Belum Diproses</strong>
                        <?php else: ?>
                            <?php echo e(\Carbon\Carbon::parse($ticket->updated_at)->translatedFormat('j F Y, H:i')); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo e($ticket->user->name); ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo e($ticket->user->role); ?></td>
                </tr>
                <tr>
                    <th>Kategori Tiket</th>
                    <td><?php echo e($ticket->kategori->nama); ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?php echo e($ticket->deskripsi); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if($ticket->status === 'Menunggu Konfirmasi'): ?>
                            <span class="badge badge-primary"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <?php elseif($ticket->status === 'Sedang Diproses'): ?>
                            <span class="badge badge-warning"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <?php elseif($ticket->status === 'Selesai'): ?>
                            <span class="badge badge-success"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <?php elseif($ticket->status === 'Ditolak'): ?>
                            <span class="badge badge-danger"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <?php else: ?>
                            <?php echo e(ucfirst($ticket->status)); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <?php if($ticket->status == 'Ditolak'): ?>
                    <tr>
                        <th>Alasan Penolakan</th>
                        <td><?php echo e($ticket->alasan_penolakan); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($ticket->bukti_tiket): ?>
                    <tr>
                        <th>Bukti Tiket</th>
                        <td>
                            <?php if($ticket->bukti_tiket): ?>
                                <?php $__currentLoopData = $ticket->bukti_tiket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(asset($foto)); ?>" target="_blank">Lihat Bukti Tiket[<?php echo e($loop->iteration); ?>]<br></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p> Tidak ada Foto Bukti </p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
            <?php if($ticket->status == 'Menunggu Konfirmasi'): ?>
                <div class="mb-2 mt-4">
                    <form action="<?php echo e(route('admin.ticket.process', $ticket->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-block">Proses</button>
                    </form>
                </div>
            <?php elseif($ticket->status == 'Sedang Diproses'): ?>
                <div class="mb-2 mt-4">
                    <form action="<?php echo e(route('admin.ticket.complete', $ticket->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-block">Selesaikan</button>
                    </form>
                </div>
                <div class="mb-2 mt-2">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                        data-target="#rejectModal">Tolak</button>
                </div>
            <?php endif; ?>
            <a href="<?php echo e(route('admin.ticket.index')); ?>" class="btn btn-secondary btn-block mb-3  mt-2">Kembali</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.ticket.reject', $ticket->id)); ?>" method="POST">
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
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/ticket/show.blade.php ENDPATH**/ ?>