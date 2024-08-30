<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between mb-5 mt-3">
            <div>
                <h1 class="fw-bold text-secondary">Ticketing</h1>
                <h4 class="fw-semibold text-secondary">Laporkan Permasalahan anda disini</h4>
            </div>
            <div>
                <a href="<?php echo e(route('seller.tiket.createTicketing')); ?>" class="btn btn-kalasewa mt-3">Buat Tiket</a>
            </div>
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
        </ol>

        <div class="table-responsive">
            <table class="table tabel-data no-more-tables" id="series-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Deskripsi Masalah</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Alasan Penolakan</th>
                    </tr>
                </thead>
                <?php if($items): ?>
                    <tbody id="series-table">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td width="4%"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->kategori->nama); ?></td>
                                <td><?php echo e($item->created_at->translatedFormat('d/m/Y')); ?></td>
                                <td><?php echo e($item->deskripsi); ?></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#modalBukti-<?php echo e($item->id); ?>"
                                        class="text-danger">Lihat Bukti
                                        Permasalahan</a>
                                </td>
                                <td>
                                    <?php if($item->status == 'Menunggu Konfirmasi'): ?>
                                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                    <?php elseif($item->status == 'Sedang Diproses'): ?>
                                        <span class="badge badge-info">Sedang Diproses</span>
                                    <?php elseif($item->status == 'Selesai'): ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td> <?php echo e($item->alasan_penolakan ? $item->alasan_penolakan : '-'); ?> </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="modalBukti-<?php echo e($item->id); ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Permasalahan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="row">
                                                    <?php if($item->bukti_tiket): ?>
                                                        <?php $__currentLoopData = $item->bukti_tiket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col my-2">
                                                                <div class="product-image-container-review">
                                                                    <img src="<?php echo e(asset($f)); ?>" alt="Bukti Tiket"
                                                                        class="product-image-review">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <p> Tidak ada Foto Bukti </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
<script>
    $('.tabel-data').DataTable({
        lengthMenu: [
            [5, 10, 25, -1],
            [5, 10, 25, 'All']
        ],
    });
</script>
<?php $__env->stopSection(); ?>
<link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">
<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi3/tiket/ticketing.blade.php ENDPATH**/ ?>