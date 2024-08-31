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
                                    <a class="nav-link active" aria-current="page" href="<?php echo e(route('viewHistoryDibatalkan')); ?>">Dibatalkan <?php if($countDibatalkan): ?>
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
                                                <th>Alasan Pembatalan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                    <td class="text-danger"><?php echo e($order->alasan_pembatalan); ?></td>
                                                    <td>
                                                        <?php if($order->status == 'Dibatalkan Pemilik Sewa'): ?>
                                                            Dibatalkan Toko, Silahkan cek <a href="<?php echo e(route('viewPenarikan')); ?>" class="text-danger fw-bold">halaman penarikan
                                                                saldo</a> untuk melakukan penarikan
                                                        <?php elseif($order->status == 'Refund di Ajukan'): ?>
                                                            Silahkan cek <a href="<?php echo e(route('viewPenarikan')); ?>" class="text-danger fw-bold">halaman penarikan
                                                                saldo</a> untuk melakukan penarikan
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <!-- Modal for Resi -->
                                                <div class="modal fade" id="refundModal-<?php echo e($loop->iteration); ?>" tabindex="-1"
                                                    aria-labelledby="refundModalLabel-<?php echo e($loop->iteration); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="refundModalLabel-<?php echo e($loop->iteration); ?>">
                                                                    Ajukan Refund</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <?php echo csrf_field(); ?>
                                                            <form action="<?php echo e(route('setRekening', ['orderId' => $order->nomor_order])); ?>" method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body">

                                                                    <?php if($saldos->nomor_rekening ?? false): ?>
                                                                    <?php else: ?>
                                                                        <div class="bank-wallet" style="margin-top: -15px;">
                                                                            <label for="exampleInputEmail1" class="form-label">Bank/E-Wallet<span class="text-danger">*</span></label>
                                                                            <select class="form-select form-control-lg select2" id="selectRekening" aria-label="Default select example"
                                                                                name='tujuan_rek' required>
                                                                                <option></option>
                                                                                <?php $__currentLoopData = $rekenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rekening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($rekening->id); ?>">
                                                                                        <?php echo e($rekening->nama); ?>

                                                                                    </option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                pilih Bank
                                                                                atau E-Wallet yang anda gunakan</div>
                                                                        </div>

                                                                        <div class="nomor-rekening mt-2">
                                                                            <label for="exampleInputEmail1" class="form-label">Nomor
                                                                                Rekening Bank/E-Wallet<span class="text-danger">*</span></label>
                                                                            <input class="form-control form-control-lg" type="number" name='nomor_rekening' required>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                masukkan
                                                                                nomor rekening/e-wallet anda</div>
                                                                        </div>

                                                                        <div class="atas-nama mt-2">
                                                                            <label for="exampleInputEmail1" class="form-label">Atas
                                                                                Nama<span class="text-danger">*</span></label>
                                                                            <input class="form-control form-control-lg" type="text" name='nama_rekening' required>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                masukkan
                                                                                nama yang terdaftar di Rekening/E-Wallet
                                                                                anda</div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/penyewa/history/dibatalkan.blade.php ENDPATH**/ ?>