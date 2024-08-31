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
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistorySedangBerlangsung')); ?>">Sedang Digunakan
                                        <?php if($countSedangBerlangsung): ?>
                                            <span class="position-top badge rounded-pill bg-danger">
                                                <?php echo e($countSedangBerlangsung); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?php echo e(route('viewHistoryTelahKembali')); ?>">Dikirim
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
                                    <a class="nav-link text-secondary" href="<?php echo e(route('viewHistoryDiretur')); ?>">Diretur
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
                                    <table class="table" id="table-history">
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
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($order->status == 'Telah Kembali'): ?>
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
                                                            <?php if($order->status == 'Telah Kembali'): ?>
                                                                <?php if($order->cekDendaDiproses()): ?>
                                                                    Anda memiliki denda pada penyewaan ini. Harap segera dilunaskan.
                                                                <?php else: ?>
                                                                    Barang Dikirim, Menunggu Review Toko
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($order->cekDendaDiproses()): ?>
                                                                <a class="btn btn-danger w-100"
                                                                    href="<?php echo e(route('viewPenyewaanSelesai', ['orderId' => $order->nomor_order])); ?>">Bayar</a>
                                                            <?php else: ?>
                                                                <a class="btn btn-danger w-100"
                                                                    href="<?php echo e(route('viewPenyewaanSelesai', ['orderId' => $order->nomor_order])); ?>">Detail</a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(url('/chat' . '/' . $order->toko->id_user)); ?>" target="_blank" class="no-underline"><button type="button"
                                                                    class="btn btn-outline-success w-100 mt-1">Chat Toko</button></a>
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
                                                                    <p>Nomor Resi: <strong><?php echo e($order->nomor_resi); ?></strong></p>
                                                                    <img src="<?php echo e(asset($order->bukti_resi_pengembalian)); ?>" alt="Resi" class="rounded img-fluid mt-3">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
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
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/penyewa/history/telahkembali.blade.php ENDPATH**/ ?>