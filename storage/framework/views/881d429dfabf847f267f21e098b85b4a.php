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
                                    <div class="table-responsive">
                                        <table id="tabel"
                                            class="no-more-tables table w-100 tabel-data align-items-center"
                                            style="word-wrap: break-word;">
                                            <?php if($order): ?>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Nomor Order</th>
                                                        <th class="col-2">Produk</th>
                                                        <th>Penyewa</th>
                                                        <th>Ukuran</th>
                                                        <th>Kurir</th>
                                                        <th class="col-3">Tujuan Pengiriman</th>
                                                        <th>Additional</th>
                                                        <th>Periode Sewa</th>
                                                        <th>Harga Penyewaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td data-title="#" class="align-middle">
                                                                <?php echo e($loop->iteration); ?>

                                                            </td>
                                                            <td data-title="Tanggal Transaksi" class="align-middle">
                                                                <?php echo e($ord->tanggalFormatted($ord->created_at)); ?>

                                                            </td>
                                                            <td data-title="No. Order" class="align-middle">
                                                                <?php echo e($ord->nomor_order); ?>

                                                            </td>
                                                            <td data-title="Produk" class="align-middle">
                                                                <h5 class=""><?php echo e($ord->id_produk_order->nama_produk); ?>

                                                                </h5>
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
                                                                <?php echo e($ord->id_produk_order->ukuran_produk); ?>

                                                            </td>
                                                            <td data-title="Kurir" class="align-middle">
                                                                <?php echo e($ord->metode_kirim); ?>

                                                            </td>
                                                            <td data-title="Tujuan Pengiriman" class="align-middle">
                                                                <?php echo e($ord->tujuan_pengiriman); ?>

                                                            </td>
                                                            <td data-title="Additional"
                                                                class="align-middle text-opacity-75">
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
                                                            <td data-title="Periode Sewa" class="align-middle">
                                                                <?php echo e($ord->tanggalFormatted($ord->tanggal_mulai)); ?> <span
                                                                    class="fw-bolder"> s.d. </span>
                                                                <?php echo e($ord->tanggalFormatted($ord->tanggal_selesai)); ?>

                                                            </td>
                                                            <td data-title="Total Harga" class="align-middle">
                                                                Rp <?php echo e(number_format($ord->total_harga, 0, '', '.')); ?></td>
                                                            <td data-title="aksi" class="align-middle">
                                                                <a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#inputResi-<?php echo e($ord->nomor_order); ?>"
                                                                    class="d-grid btn btn-success m-2"
                                                                    id="proses-<?php echo e($ord->nomor_order); ?>">Input
                                                                    Resi</a>
                                                                <a href="<?php echo e(url('/chat' . '/' . $ord->id_penyewa_order->id)); ?>"
                                                                    target="_blank"
                                                                    class="d-grid btn btn-outline-success m-2"
                                                                    id="proses">Chat</a>
                                                                <a class="d-grid btn btn-outline-danger m-2"
                                                                    id="aksi-batalkan-<?php echo e($ord->nomor_order); ?>"
                                                                    type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#batalkan-<?php echo e($ord->nomor_order); ?>">Batalkan</button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal Input Resi -->
                                                        <div class="modal fade" id="inputResi-<?php echo e($ord->nomor_order); ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="inputResi-<?php echo e($ord->nomor_order); ?>Label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <form
                                                                    action="<?php echo e(route('seller.statuspenyewaan.inputResi', $ord->nomor_order)); ?>"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="inputResi-<?php echo e($ord->nomor_order); ?>Label">
                                                                                Input Resi</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="m-2">
                                                                                <p for="exampleFormControlInput1"
                                                                                    class="form-label">
                                                                                    Nomor Order :
                                                                                    <?php echo e($ord->nomor_order); ?>

                                                                                </p>
                                                                                <p for="exampleFormControlInput1"
                                                                                    class="form-label">
                                                                                    Produk :
                                                                                    <?php echo e($ord->id_produk_order->nama_produk); ?>

                                                                                </p>
                                                                                <small class="fw-light mb-3"
                                                                                    style="font-size:14px"><?php echo e($ord->id_produk_order->brand); ?>,
                                                                                    Rp.<?php echo e(number_format($ord->id_produk_order->harga)); ?>/3hari,
                                                                                    Ukuran
                                                                                    <?php echo e($ord->id_produk_order->ukuran_produk); ?></small>
                                                                                <hr
                                                                                    class="border border-secondary opacity-50 my-4">
                                                                                <label for="inputResi"
                                                                                    class="form-label">Nomor
                                                                                    Resi<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    class="form-control mb-3"
                                                                                    name="nomor_resi" id="inputResi"
                                                                                    required>
                                                                                <label for="inputResi"
                                                                                    class="form-label">Foto Bukti
                                                                                    Resi<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="file"
                                                                                    class="form-control mb-3"
                                                                                    name="foto_bukti_resi" id="fotoresi"
                                                                                    accept=".jpg,.png,.jpeg,.webp"
                                                                                    required>
                                                                                <label for="fotoresi"
                                                                                    class="form-label">Ongkir<span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1">Rp</span>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="biaya_pengiriman"
                                                                                        id="biaya_pengiriman"
                                                                                        placeholder="Masukkan biaya ongkir yang anda bayar"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <p class="m-2 mt-2">Setelah submit nomor resi
                                                                                maka
                                                                                status akan berubah
                                                                                menjadi
                                                                                pengiriman.
                                                                                Pastikan bahwa nomor resi telah sesuai
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-kalasewa">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Batalkan -->
                                                        <div class="modal fade" id="batalkan-<?php echo e($ord->nomor_order); ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="batalkan-<?php echo e($ord->nomor_order); ?>Label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <form
                                                                    action="<?php echo e(route('seller.statuspenyewaan.dibatalkanPemilikSewa', $ord->nomor_order)); ?>"
                                                                    method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="batalkan-<?php echo e($ord->nomor_order); ?>Label">
                                                                                Batalkan</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="m-2">
                                                                                <p class="mt-2 fw-bold">Anda akan
                                                                                    membatalkan Penyewaan berikut :
                                                                                </p>
                                                                                <p for="exampleFormControlInput1"
                                                                                    class="form-label">
                                                                                    Nomor Order :
                                                                                    <?php echo e($ord->nomor_order); ?>

                                                                                </p>
                                                                                <p for="exampleFormControlInput1"
                                                                                    class="form-label">
                                                                                    Produk :
                                                                                    <?php echo e($ord->id_produk_order->nama_produk); ?>

                                                                                </p>
                                                                                <small class="fw-light mb-3"
                                                                                    href=""
                                                                                    style="font-size:14px"><?php echo e($ord->id_produk_order->brand); ?>,
                                                                                    Rp.<?php echo e(number_format($ord->id_produk_order->harga)); ?>/3hari,
                                                                                    Ukuran
                                                                                    <?php echo e($ord->id_produk_order->ukuran_produk); ?></small>
                                                                                <hr
                                                                                    class="border border-secondary opacity-50 my-4">
                                                                                <label for="alasan_batal"
                                                                                    class="form-label">Alasan
                                                                                    Pembatalan</label>
                                                                                <textarea type="text" class="form-control" name="alasan_batal" id="alasan_batal" required> </textarea>
                                                                            </div>
                                                                            <small class="m-2 mt-2">Pastikan anda telah
                                                                                berdiskusi
                                                                                dengan user terkait pembatalan penyewaan ini
                                                                            </small>
                                                                            <hr
                                                                                class="border border-secondary opacity-50 my-4">
                                                                            <p class="m-2 mt-2">Jika produk telah anda
                                                                                batalkan, status produk akan menjadi
                                                                                "arsip".
                                                                                <span class="fw-bold text-danger">Mohon
                                                                                    aktifkan
                                                                                    Produk secara manual pada
                                                                                    menu produk </span> agar bisa disewa
                                                                                kembali
                                                                                ketika sudah ready
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-kalasewa">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            <?php endif; ?>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="modal" id="modal_auto" tabindex="-1"
                                    aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bolder" id="exampleModalCenterTitle">
                                                    Mohon Perhatian</h1>
                                            </div>
                                            <div class="modal-body">
                                                <p>Harap
                                                    <span class="fw-bolder text-danger">rekam video saat pengemasan sebelum
                                                        mengirimkan barang </span> sebagai bukti jika barang
                                                    bermasalah saat tiba di penyewa atau saat kembali lagi ke anda
                                                </p>
                                                <p>Mohon kirimkan barang
                                                    <span class="fw-bolder text-danger">sebelum awal mulai periode
                                                        sewa</span>.
                                                    Jika awal mulai sewa adalah 15, maka kirimkan tanggal 14
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                Klik diluar popup ini untuk menutup
                                            </div>
                                        </div>
                                    </div>
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
        });
    </script>
    <script src="<?php echo e(asset('seller/modal_auto_muncul.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa v2\resources\views/pemilikSewa/iterasi2/pesanan/belumdiproses.blade.php ENDPATH**/ ?>