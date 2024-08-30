<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Status Penyewaan</h1>
                <h4 class="fw-semibold text-secondary">Lihat, dan kelola Penyewaan anda disini</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <?php echo $__env->make('pemilikSewa.iterasi2.pesanan.navtabs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active mt-3" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
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
                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="text-dark rounded-3">
                                    <table id="tabel" class="no-more-tables table w-100 tabel-data align-items-center"
                                        style="word-wrap: break-word;">
                                        <?php if($order): ?>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nomor Order</th>
                                                    <th class="col-2">Produk</th>
                                                    <th>Penyewa</th>
                                                    <th>Ukuran</th>
                                                    <th>Additional</th>
                                                    <th>Harga Penyewaan</th>
                                                    <th>Nomor Resi Pengembalian</th>
                                                    <th>Dikembalikan Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td data-title="#" class="align-middle">
                                                            <?php echo e($loop->iteration); ?></td>
                                                        <td data-title="No. Order" class="align-middle">
                                                            <?php echo e($ord->nomor_order); ?></td>
                                                        <td data-title="Produk" class="align-middle">
                                                            <h5 class=""><?php echo e($ord->id_produk_order->nama_produk); ?></h5>
                                                            <small class="fw-light" href=""
                                                                style="font-size:14px"><?php echo e($ord->id_produk_order->brand); ?>,
                                                                Rp.<?php echo e(number_format($ord->id_produk_order->harga)); ?>/3hari</small>
                                                        </td>
                                                        <td data-title="Nama Penyewa" class="align-middle">
                                                            <h5><?php echo e($ord->id_penyewa_order->nama); ?></h5>
                                                            <a class="fw-light"
                                                                href="<?php echo e(route('seller.view.penilaian.reviewPenyewa', $ord->id_penyewa_order->id)); ?>"
                                                                style="font-size:14px">Lihat Review
                                                                Penyewa</a>
                                                        </td>
                                                        <td data-title="Ukuran" class="align-middle">
                                                            <?php echo e($ord->id_produk_order->ukuran_produk); ?></td>
                                                        <td data-title="Additional" class="align-middle text-opacity-75">
                                                            <?php if($ord->additional): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $ord->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><?php echo e($add['nama']); ?> +
                                                                            <?php echo e(number_format($add['harga'], 0, '', '.')); ?>

                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <div class="text-opacity-25">-</div>
                                                            <?php endif; ?>
                                                            <?php if($ord->id_produk_order->biaya_cuci): ?>
                                                                <ul>
                                                                    <li>Biaya cuci +
                                                                        <?php echo e(number_format($ord->id_produk_order->biaya_cuci, 0, '', '.')); ?>

                                                                    </li>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td data-title="Harga Penyewaan" class="align-middle">
                                                            Rp <?php echo e(number_format($ord->total_harga, 0, '', '.')); ?></td>
                                                        <td data-title="Nomor Resi Pengiriman" class="align-middle">
                                                            <?php echo e($ord->status == 'Retur dalam Pengiriman' ? $ord->nomor_resi : 'Belum ada'); ?>

                                                        </td>
                                                        <td data-title="Dikembalikan" class="align-middle">
                                                            <?php echo e(!$ord->tanggal_pengembalian ? 'Belum ada' : $ord->tanggalFormatted($ord->tanggal_pengembalian)); ?>

                                                        </td>
                                                        <td data-title="aksi" class="align-middle">
                                                            <?php if($ord->status == 'Retur dalam Pengiriman'): ?>
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#selesaikanPenyewaan-1"
                                                                    class="d-grid btn btn-success mb-2"
                                                                    id="proses">Konfirmasi
                                                                    Diterima</a>
                                                            <?php elseif($ord->status == 'Retur'): ?>
                                                                <p> Retur menunggu diproses oleh admin. Anda akan dikontak
                                                                    admin mengenai retur ini melalui whatsapp</p>
                                                            <?php elseif($ord->status == 'Retur Dikonfirmasi'): ?>
                                                                <p> Retur telah dikonfirmasi. Menunggu dikirimkan
                                                                    oleh penyewa</p>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if($ord->status == 'Retur dalam Pengiriman'): ?>
                                                        <!-- Modal Konfirmasi Sewa -->
                                                        <div class="modal fade" id="selesaikanPenyewaan-1" tabindex="-1"
                                                            aria-labelledby="inputResi-1Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <form
                                                                    action="<?php echo e(route('seller.statuspenyewaan.returSelesai', ['nomor_order' => $ord->nomor_order])); ?>"
                                                                    method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="inputResi-1Label">
                                                                                Konfirmasi Barang
                                                                                Diterima</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Nomor Order :
                                                                                <?php echo e($ord->nomor_order); ?></p>
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Produk :
                                                                                <?php echo e($ord->id_produk_order->nama_produk); ?>

                                                                            </p>
                                                                            <small class="fw-light mb-3" href=""
                                                                                style="font-size:14px"><?php echo e($ord->id_produk_order->brand); ?>,
                                                                                Ukuran
                                                                                <?php echo e($ord->id_produk_order->ukuran_produk); ?></small>
                                                                            <hr>
                                                                            <p class="mt-2">
                                                                                Setelah konfirmasi barang retur diterima,
                                                                                status
                                                                                produk akan
                                                                                menjadi "arsip". <span
                                                                                    class="fw-bold text-danger">Mohon
                                                                                    aktifkan
                                                                                    Produk secara manual pada
                                                                                    menu produk </span> agar bisa disewa
                                                                                kembali
                                                                                ketika sudah ready. </p>
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-kalasewa">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.tabel-data').DataTable({
            lengthMenu: [
                [5, 10, 25, -1],
                [5, 10, 25, 'All']
            ],
            // fixedHeader: true,
            // order: [
            //     [6, 'asc']
            // ],
            // rowGroup: {
            //     dataSrc: 6
            // }
        });
    </script>
    <script src="<?php echo e(asset('seller/modal_auto_muncul.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi2/pesanan/sewaRetur.blade.php ENDPATH**/ ?>