<?php $__env->startSection('title'); ?>
    <?php if($refund->user->role == 'penyewa'): ?>
        Detail Pengembalian Dana
    <?php elseif($refund->user->role == 'pemilik_sewa'): ?>
        Detail Pencairan Dana
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <?php if($refund->user->role == 'penyewa'): ?>
                Detail Pengembalian Dana
            <?php elseif($refund->user->role == 'pemilik_sewa'): ?>
                Detail Pencairan Dana
            <?php endif; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pengembalian Dana</li>
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

    <div class="card mb-5">
        <div class="card-body">
            <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($refund->created_at)->translatedFormat('j F Y')); ?></p>
            <p><strong>Nama:</strong> <?php echo e($refund->user->nama); ?></p>
            <p><strong>Nominal:</strong> <?php echo e(number_format($refund->nominal, 2, ',', '.')); ?></p>
            <p><strong>Bank:</strong> <?php echo e($refund->bank); ?></p>
            <p><strong>Nomor Rekening:</strong> <?php echo e($refund->nomor_rekening); ?></p>
            <p><strong>Nama Rekening:</strong> <?php echo e($refund->nama_rekening); ?></p>

            <?php if($refund->status == 'Sedang Diproses'): ?>
                <form action="<?php echo e(route('admin.refunds.transfer', $refund->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="bukti_transfer"><strong>Upload Bukti Transfer</strong></label>
                        <input type="file" class="form-control" name="bukti_transfer" id="bukti_transfer"
                            accept=".jpg,.png,.jpeg,.pdf" required>
                        <div id="bukti_transfer_alert" class="alert alert-danger mt-2" style="display: none;">
                            Silakan unggah bukti transfer.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="btn-submit">Kirim</button>
                </form>
                <?php if($refund->status == 'Sedang Diproses'): ?>
                    <button type="button" class="btn btn-danger btn-block mt-2" data-toggle="modal"
                        data-target="#rejectModal">Tolak</button>
                <?php endif; ?>
            <?php elseif($refund->status == 'Selesai' || $refund->status == 'Ditolak'): ?>
                <div class="form-group">
                    <label><strong>Bukti Transfer:</strong></label>
                    <?php if(!empty($refund->bukti_transfer)): ?>
                        <a href="<?php echo e(asset($refund->bukti_transfer)); ?>" target="_blank">Lihat Bukti Transfer</a>
                    <?php else: ?>
                        <p>Tidak ada bukti transfer.</p>
                    <?php endif; ?>
                </div>
                <?php if($refund->status == 'Ditolak'): ?>
                    <div class="form-group">
                        <label><strong>Alasan Penolakan:</strong></label>
                        <p><?php echo e($refund->alasan_penolakan); ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary btn-block mt-2">Kembali</a>
        </div>
    </div>

    <!-- Alasan Penolakan Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rejectForm" action="<?php echo e(route('admin.refunds.reject')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="refund_id" value="<?php echo e($refund->id); ?>">
                        <div class="form-group">
                            <label for="alasan_penolakan">Alasan Penolakan</label>
                            <select class="form-control" id="alasan_penolakan" name="alasan_penolakan">
                                <option value="Nomor Rekening tidak valid">Nomor Rekening tidak valid</option>
                                <option value="Nama Rekening tidak sesuai">Nama Rekening tidak sesuai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Kirim</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#bukti_transfer').on('change', function() {
                var fileInput = $(this)[0];
                if (fileInput.files.length > 0) {
                    $('#btn-submit').prop('disabled', false);
                } else {
                    $('#btn-submit').prop('disabled', true);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/refunds/show.blade.php ENDPATH**/ ?>