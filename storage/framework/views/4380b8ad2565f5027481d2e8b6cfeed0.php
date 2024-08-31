<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <a href="<?php echo e(route('seller.statuspenyewaan.telahkembali')); ?>" class="btn btn-outline-danger"><i
                    class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
            <div class="d-flex justify-content-between mb-4 mt-3">
                <div>
                    <h1 class="fw-bold text-secondary">Ajukan Denda Sewa</h1>
                    <h4 class="text-secondary">Anda akan mengajukan denda untuk penyewaan dengan nomor order
                        <?php echo e($order->nomor_order); ?></h4>
                </div>
            </div>
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
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <hr>
            <div class="card mb-3">
                <div class="card-body btn text-start" type="button" id="toggleOrder">
                    <div class="m-2">
                        <h4 class="form-h4">Detail Order<i class="fa-solid fa-chevron-down ms-3" id="icon-chevron"></i></h4>
                    </div>
                </div>
                <div class="collapsing" id="detailOrder">
                    <div class="card-body">
                        <div class="m-2">
                            <div class="accordion-body">
                                <div class="text-dark rounded-3">
                                    <table id="tabel"
                                        class="no-more-tables table w-100 tabel-responsive align-items-center"
                                        style="word-wrap: break-word;">
                                        <?php if($order): ?>
                                            <thead>
                                                <tr>
                                                    <th>Nomor Order</th>
                                                    <th>Produk</th>
                                                    <th>Penyewa</th>
                                                    <th>Ukuran</th>
                                                    <th>Periode Sewa Tanggal</th>
                                                    <th>Harga Penyewaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td data-title="No. Order" class="align-middle">
                                                        <?php echo e($order->nomor_order); ?></td>
                                                    <td data-title="Produk" class="align-middle">
                                                        <h5 class=""><?php echo e($order->id_produk_order->nama_produk); ?></h5>
                                                        <small class="fw-light" href=""
                                                            style="font-size:14px"><?php echo e($order->id_produk_order->brand); ?>,
                                                            Rp.<?php echo e(number_format($order->id_produk_order->harga)); ?>/3hari</small>
                                                    </td>
                                                    <td data-title="Nama Penyewa" class="align-middle">
                                                        <h5><?php echo e($order->id_penyewa_order->nama); ?></h5>
                                                        <a class="fw-light"
                                                            href="<?php echo e(route('seller.view.penilaian.reviewPenyewa', $order->id_penyewa_order->id)); ?>"
                                                            style="font-size:14px">Lihat Review
                                                            Penyewa</a>
                                                    </td>
                                                    <td data-title="Ukuran" class="align-middle">
                                                        <?php echo e($order->id_produk_order->ukuran_produk); ?></td>
                                                    <td data-title="Periode Sewa" class="align-middle">
                                                        <?php echo e($order->tanggalFormatted($order->tanggal_mulai)); ?> <span
                                                            class="fw-bolder"> s.d. </span>
                                                        <?php echo e($order->tanggalFormatted($order->tanggal_selesai)); ?>

                                                    </td>
                                                    <td data-title="Total + Denda" class="align-middle">
                                                        <?php echo e(number_format($order->total_harga, 0, '', '.')); ?></td>
                                                </tr>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="m-2 mb-4">
                        <h4 class="form-h4">Pengajuan Anda
                        </h4>
                    </div>
                    <table id="tabel" class="no-more-tables table w-100 tabel-responsive align-items-center"
                        style="word-wrap: break-word;">
                        <?php if($list_denda): ?>
                            <thead>
                                <tr>
                                    <th>Nomor Order</th>
                                    <th>Peraturan</th>
                                    <th>Nominal Denda</th>
                                    <th>Foto Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $list_denda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $denda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-title="No. Order" class="align-middle">
                                            <?php echo e($order->nomor_order); ?></td>
                                        <td data-title="Peraturan" class="align-middle">
                                            <?php echo e($denda->peraturan->nama); ?></td>
                                        <td data-title="Nominal Denda" class="align-middle">
                                            Rp. <?php echo e(number_format($denda->nominal_denda, 0, '', '.')); ?>

                                        <td data-title="Foto Bukti" class="align-middle">
                                            <a data-bs-toggle="modal" data-bs-target="#modalBukti-<?php echo e($denda->id); ?>"
                                                class="text-danger">Lihat Foto Bukti</a>
                                        </td>
                                        <td data-title="Status" class="align-middle">
                                            <?php if($denda->status == 'ditolak'): ?>
                                                <span class="badge badge-danger"><?php echo e(ucwords($denda->status)); ?> </span>
                                            <?php elseif($denda->status == 'penyewa_kabur'): ?>
                                                <span class="badge badge-dark">Penyewa Tidak Membayarkan</span>
                                            <?php elseif($denda->status == 'lunas'): ?>
                                                <span class="badge badge-success"><?php echo e(ucwords($denda->status)); ?></span>
                                            <?php elseif($denda->status == 'dibatalkan'): ?>
                                                <span class="badge badge-dark"><?php echo e(ucwords($denda->status)); ?></span>
                                            <?php elseif($denda->status == 'pending'): ?>
                                                <span class="badge badge-warning"><?php echo e(ucwords($denda->status)); ?></span>
                                            <?php elseif($denda->status == 'diproses'): ?>
                                                <span class="badge badge-info"><?php echo e(ucwords($denda->status)); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-title="Aksi" class="align-middle">
                                            <?php if($denda->status == 'ditolak'): ?>
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#alasan-ditolak-<?php echo e($denda->id); ?>"
                                                    class="btn btn-outline-danger" id="denda">Lihat
                                                    Alasan Ditolak</a>
                                            <?php elseif($denda->status == 'pending'): ?>
                                                <form
                                                    action="<?php echo e(route('seller.batalkanPengajuanDendaAction', ['nomor_order' => $order->nomor_order, 'id' => $denda->id])); ?>"
                                                    method="POST" style="margin-block-end: 0em;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        id="denda">Batalkan
                                                        Pengajuan</button>
                                                </form>
                                            <?php else: ?>
                                                Tidak ada aksi yang dapat dilakukan
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        <?php endif; ?>
                    </table>
                    <?php $__currentLoopData = $list_denda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $denda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Modal -->
                        <?php if($denda->status == 'ditolak'): ?>
                            <div class="modal fade" id="alasan-ditolak-<?php echo e($denda->id); ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alasan Ditolak</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo e($denda->alasan_penolakan); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="modal fade" id="modalBukti-<?php echo e($denda->id); ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Bukti</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="row">
                                                    <?php if($denda->foto_bukti): ?>
                                                        <?php $__currentLoopData = $denda->foto_bukti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleOrder').addEventListener('click', toggleCollapse)

        function toggleCollapse() {
            const bodyCardDetail = document.getElementById('detailOrder');
            const icon = document.getElementById('icon-chevron');

            if (bodyCardDetail.classList.contains('collapse') && bodyCardDetail.classList.contains('show')) {
                bodyCardDetail.classList.remove('show');
                bodyCardDetail.classList.add('collapsing');
                icon.classList.add('fa-chevron-down');
                icon.classList.remove('fa-chevron-up');
            } else if (bodyCardDetail.classList.contains('collapsing')) {
                bodyCardDetail.classList.remove('collapsing');
                bodyCardDetail.classList.add('collapse');
                bodyCardDetail.classList.add('show');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/pemilikSewa/iterasi3/denda/detailPengajuanDenda.blade.php ENDPATH**/ ?>