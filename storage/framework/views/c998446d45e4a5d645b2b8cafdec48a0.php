<?php $__env->startSection('content'); ?>

    <style>
        .no-underline {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
            /* Inherit the color from the parent element or set it explicitly */
        }
    </style>

    <section>

        <div class="header-text-content mt-5 text-center">
            <div class="container-fluid">
                <div class="container">
                    <h1><strong>History Penyewaan</strong></h1>
                </div>
            </div>
        </div>

        <div class="container mt-2">
            <?php echo csrf_field(); ?>
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

        </div>

        <div class="button-content mt-5">
            <div class="container-fluid">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="historyTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryMenungguDiproses')); ?>">Menunggu Konfirmasi
                                        <?php if($countMenungguDiproses): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countMenungguDiproses); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryDalamPengiriman')); ?>">Dalam
                                        Pengiriman <?php if($countDalamPengiriman): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countDalamPengiriman); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistorySedangBerlangsung')); ?>">Sedang
                                        Digunakan <?php if($countSedangBerlangsung): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countSedangBerlangsung); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryTelahKembali')); ?>">Dikirim
                                        Kembali <?php if($countTelahKembali): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countTelahKembali); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryDibatalkan')); ?>">Dibatalkan
                                        <?php if($countDibatalkan): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countDibatalkan); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?php echo e(route('viewHistoryDiretur')); ?>">Diretur
                                        <?php if($countDiretur): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countDiretur); ?>

                                            </span>
                                        <?php endif; ?>


                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryPenyewaanSelesai')); ?>">Penyewaan
                                        Selesai</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <?php if($orders): ?>
                                    <table class="table w-100" id="table-history">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nomor Order</th>
                                                <th>Nama Produk</th>
                                                <th>Additional</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Total Biaya</th>
                                                <th>Resi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($order->status == 'Retur' or $order->status == 'Retur Dikonfirmasi' or $order->status == 'Retur dalam Pengiriman'): ?>
                                                    <tr>
                                                        <td data-title="#" class="text-center">
                                                            <?php echo e($loop->iteration); ?>

                                                        </td>
                                                        <td><?php echo e($order->nomor_order); ?></td>
                                                        <td><?php echo e($order->nama_produk); ?></td>
                                                        <td>
                                                            <?php if(!empty($order->additional) && is_array($order->additional)): ?>
                                                                <?php $__currentLoopData = $order->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_array($additionalItem) && isset($additionalItem['nama'])): ?>
                                                                        <?php echo e($additionalItem['nama']); ?>

                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <p>-</p>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td><?php echo e($order->tanggal_mulai); ?></td>
                                                        <td><?php echo e($order->tanggal_selesai); ?></td>
                                                        <td>Rp<?php echo e(number_format($order->grand_total, 0, '', '.')); ?></td>
                                                        <?php if($order->bukti_resi): ?>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#resiModal-<?php echo e($loop->iteration); ?>">
                                                                    Lihat Resi
                                                                </button>
                                                            </td>
                                                        <?php else: ?>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-danger" disabled>
                                                                    Lihat Resi
                                                                </button>
                                                            </td>
                                                        <?php endif; ?>

                                                        <td>
                                                            <?php if($order->status == 'Retur'): ?>
                                                                Sedang di review Admin dan Toko
                                                            <?php elseif($order->status == 'Retur Dikonfirmasi'): ?>
                                                                Retur di Konfirmasi
                                                            <?php elseif($order->status == 'Retur dalam Pengiriman'): ?>
                                                                Retur Dalam Pengiriman
                                                            <?php endif; ?>
                                                        </td>

                                                        <td>
                                                            <?php if($order->status == 'Retur'): ?>
                                                                <button class="btn btn-danger" disabled>Retur Barang</button>
                                                            <?php elseif($order->status == 'Retur Dikonfirmasi'): ?>
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#refundModal-<?php echo e($loop->iteration); ?>">
                                                                    Retur Barang
                                                                </button>
                                                            <?php elseif($order->status == 'Retur dalam Pengiriman'): ?>
                                                                <button class="btn btn-danger" disabled>Retur Barang</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for Resi -->
                                                    <div class="modal fade" id="resiModal-<?php echo e($loop->iteration); ?>" tabindex="-1"
                                                        aria-labelledby="resiModalLabel-<?php echo e($loop->iteration); ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="resiModalLabel-<?php echo e($loop->iteration); ?>">
                                                                        Bukti
                                                                        Resi</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php if($order->status == 'Retur'): ?>
                                                                        <p>Nomor Resi: <strong><?php echo e($order->nomor_resi); ?></strong></p>
                                                                        <img src="<?php echo e(asset($order->bukti_resi)); ?>" alt="Resi" class="img-fluid">
                                                                    <?php elseif($order->status == 'Retur Dikonfirmasi'): ?>
                                                                        <p>Nomor Resi: <strong><?php echo e($order->nomor_resi); ?></strong></p>
                                                                        <img src="<?php echo e(asset($order->bukti_resi)); ?>" alt="Resi" class="img-fluid">
                                                                    <?php elseif($order->status == 'Retur dalam Pengiriman'): ?>
                                                                        <p>Nomor Resi: <strong><?php echo e($order->nomor_resi); ?></strong></p>
                                                                        <img src="<?php echo e(asset($order->bukti_resi_pengembalian)); ?>" alt="Resi" class="img-fluid">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Refund Modal -->
                                                    <div class="modal fade" id="refundModal-<?php echo e($loop->iteration); ?>" tabindex="-1" aria-labelledby="refundModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="refundModalLabel">Retur Barang</h1>

                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="<?php echo e(route('returBarangRefund', ['orderId' => $order->nomor_order])); ?>" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-body">
                                                                        <div class="alamat-pengembalian" style="margin-top: -20px;">
                                                                            <label for="exampleInputEmail1" class="form-label">Alamat
                                                                                Pengembalian</label>
                                                                            <textarea name="alamatpengembalian" placeholder="Alamat Pengembalian Produk" class="form-control form-control-lg w-100" readonly><?php echo e($order->id_produk_order->getalamatproduk($order->id_produk_order->alamat, $order->id_produk_order->toko->id_user)); ?></textarea>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                lakukan
                                                                                pengiriman kembali ke alamat yang tertera!
                                                                            </div>
                                                                        </div>
                                                                        <div class="nomor-resi mt-2">
                                                                            <label for="exampleInputEmail1" class="form-label">Nomor
                                                                                Resi<span class="text-danger">*</span></label>
                                                                            <input type="text" name="nomor_resi" placeholder="Nomor Resi"
                                                                                class="form-control form-control-lg w-100" />
                                                                            <div id="emailHelp" class="form-text">Nomor
                                                                                resi pengiriman
                                                                                untuk pelacakan</div>
                                                                        </div>
                                                                        <div class="bukti-resi mt-2">
                                                                            <label for="formFile" class="form-label">Bukti
                                                                                Resi /
                                                                                Pengiriman<span class="text-danger">*</span></label>
                                                                            <input class="form-control" type="file" id="formFile" name="bukti_resi_penyewa"
                                                                                accept=".jpg,.png,.jpeg,.webp" required>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                berikan bukti
                                                                                gambar resi atau screenshot pengiriman
                                                                                barang!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/history/diretur.blade.php ENDPATH**/ ?>