<?php $__env->startSection('content'); ?>

<section>

    <div class="container-fluid mt-5">
        <div class="container text-center">
            <h1><strong>INFORMASI PEMESANAN</strong></h1>
        </div>
    </div>

    <div class="container mt-2">
        <?php echo csrf_field(); ?>
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
    </div>

    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-3">

                    <img src="<?php echo e(asset($order->foto_produk)); ?>" class="img-thumbnail" alt="fotoproduk">

                </div>
                <div class="col-6">

                    <form action="">

                        <h1><strong><?php echo e($order->nama_produk); ?></strong></h1>

                        <h3><strong>Informasi Pilihan Kostum</strong></h3>
                        <?php if(!empty($order->additional) && is_array($order->additional)): ?>
                        <?php $__currentLoopData = $order->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($additionalItem) && isset($additionalItem['nama'])): ?>
                        <button class="btn btn-outline-dark" type="button"><?php echo e($additionalItem['nama']); ?></button>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <button class="btn btn-outline-dark" type="button"><?php echo e($order->ukuran); ?></button>
                        <div id="emailHelp" class="form-text">Berikut adalah pilihan additional dan ukuran yang kamu
                            pilih</div>

                        <div class="datepckr d-flex mt-3">
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                                <input type="text" name="infomulai" placeholder="Tanggal Mulai Sewa"
                                    class="form-control form-control-lg w-100" value="<?php echo e($order->tanggal_mulai); ?>"
                                    readonly />
                                <div id="emailHelp" class="form-text">Tanggal mulai sewa anda!</div>
                            </div>
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Selesai</label>
                                <input type="text" name="infoselesai" placeholder="Tanggal Akhir Sewa"
                                    class="form-control form-control-lg w-100" value="<?php echo e($order->tanggal_selesai); ?>"
                                    readonly />
                                <div id="emailHelp" class="form-text">Tanggal akhir sewa anda! (3 hari penyewaan)</div>
                            </div>
                        </div>

                        <div class="namapenyewa-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Penyewa</label>
                            <input type="text" name="nama" placeholder="Nama Penyewa"
                                class="form-control form-control-lg w-100" value="<?php echo e($order->nama_penyewa); ?>"
                                readonly />
                            <div id="emailHelp" class="form-text">Nama yang terdaftar sebagai penyewa</div>
                        </div>

                        <div class="alamat-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat Penyewa<span
                                    class="text-danger">*</span></label>
                            <textarea name="alamat" placeholder="Alamat Penyewa"
                                class="form-control form-control-lg w-100"
                                readonly><?php echo e($order->tujuan_pengiriman); ?></textarea>
                            <div id="emailHelp" class="form-text">Pastikan alamat anda diisi dengan lengkap dan detail
                                untuk memudahkan pengiriman!</div>
                        </div>

                        <div class="metodekirim-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Metode Kirim</label>
                            <input type="text" name="metodekirim" placeholder="Metode Kirim"
                                class="form-control form-control-lg w-100" value="<?php echo e($order->metode_kirim); ?>"
                                readonly />
                            <div id="emailHelp" class="form-text">Metode kirim yang dipilih</div>
                        </div>

                        <div class="noresi-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Resi</label>
                            <input type="text" name="nomorresi" placeholder="Nomor Resi"
                                class="form-control form-control-lg w-100" value="<?php echo e($order->nomor_resi); ?>" readonly />
                            <div id="emailHelp" class="form-text">Nomor resi pengiriman untuk pelacakan. klik <span><a
                                        href="https://www.cekresi.com" target="_blank">disini</a></span> untuk mengecek
                                resi</div>
                        </div>
                </div>

                </form>

                <div class="col-3">

                    <div class="card">
                        <div class="card-body">
                            <h5><strong>Ringkasan Belanja</strong></h5>
                            <table class="w-100">
                                <tr>
                                    <td class="fw-bold" colspan="3">Total Barang</td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Harga Katalog</td>
                                    <td id="harga-katalog" class="text-end">Rp<?php echo e(number_format($order->harga_katalog, 0, '', '.')); ?></td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Harga Additional</td>
                                    <?php if($order->additional): ?>
                                        <?php $__currentLoopData = $order->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td id="harga-additional-total" class="text-end">Rp<?php echo e(number_format($additionalItem['harga'], 0, '', '.')); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <td id="harga-additional-total" class="text-end">Rp0</td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Harga Cuci</td>
                                    <td id="harga-cuci" class="text-end">Rp<?php echo e(number_format($order->biaya_cuci ?? 0, 0, '', '.')); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" colspan="3">Biaya Transaksi</td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Jaminan Ongkir</td>
                                    <td id="ongkos-kirim" class="text-end">Rp<?php echo e(number_format(30000, 0, '', '.')); ?></td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Jaminan Kostum</td>
                                    <td class="text-end">Rp50.000</td>
                                </tr>
                                <tr class="text-secondary">
                                    <td id="biaya-admin-label">Biaya Admin</td>
                                    <td id="biaya-admin-value" class="text-end">Rp<?php echo e(number_format($order->fee_admin, 0, '', '.')); ?></td>
                                </tr>
                            </table>
                            
                            <h5 class="mt-2"><strong>Total Tagihan</strong></h5>
                            <h4><strong
                                    id="total-tagihan">Rp<?php echo e(number_format($order->grand_total, 0, '', '.')); ?></strong>
                            </h4>

                            <hr>

                            <h5 class="mt-2"><strong>Catatan Pembayaran</strong></h5>

                            <table class="w-100">
                                <tr>
                                    <td class="fw-bold" colspan="3">Denda dan Ongkos Kirim</td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Ongkos Kirim</td>
                                    <td id="harga-ongkir-pengiriman" class="text-end">Rp<?php echo e(number_format($order->ongkir_pengiriman ?? 0, 0, '', '.')); ?></td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Denda Terlambat</td>
                                    <td id="harga-denda-keterlambatan" class="text-end">Rp<?php echo e(number_format($order->denda_keterlambatan ?? 0, 0, '', '.')); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" colspan="3">Sisa Jaminan</td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Jaminan Ongkir</td>
                                    <td id="ongkos-kirim" class="text-end">Rp<?php echo e(number_format($order->ongkir_default ?? 0, 0, '', '.')); ?></td>
                                </tr>
                                <tr class="text-secondary">
                                    <td>Jaminan Kostum</td>
                                    <td id="jaminan-kostum" class="text-end">Rp<?php echo e(number_format($order->jaminan ?? 0, 0, '', '.')); ?></td>
                                </tr>
                            </table>


                            <!-- <p class="mt-2"><strong>Denda dan Ongkos Kirim</strong></p>
                            <div class="d-flex">
                                <div class="col text-start">
                                    <p class="text-secondary">Ongkos Kirim</p>
                                    <p class="text-secondary" id="harga-additional-label">Denda Telat</p>
                                </div>
                                <div class="col text-end">
                                    <p class="text-secondary">
                                        Rp<?php echo e(number_format($order->ongkir_pengiriman ?? 0, 0, '', '.')); ?>

                                    </p>
                                    <p class="text-secondary">
                                        Rp<?php echo e(number_format($order->denda_keterlambatan ?? 0, 0, '', '.')); ?>

                                    </p>
                                </div>
                            </div>

                            <p><strong>Sisa Jaminan</strong></p>
                            <div class="d-flex">
                                <div class="col text-start">
                                    <p class="text-secondary" id="harga-additional-label">Jaminan Ongkir</p>
                                    <p class="text-secondary">Jaminan Kostum</p>
                                </div>
                                <div class="col text-end">
                                    <p class="text-secondary">
                                        Rp<?php echo e(number_format($order->ongkir_default ?? 0, 0, '', '.')); ?>

                                    </p>
                                    <?php if($order->jaminan < 0): ?> <p class="text-secondary">Rp0</p>
                                        <?php else: ?>
                                        <p class="text-secondary">
                                            Rp<?php echo e(number_format($order->jaminan ?? 0, 0, '', '.')); ?></p>
                                        <?php endif; ?>
                                </div>
                            </div> -->


                            <?php if($order->jaminan >= 0): ?>
                            <h5 class="mt-2"><strong>Total Uang Kembali</strong> <i class="ri-information-line"
                                    style="cursor: pointer" data-bs-toggle="modal"
                                    data-bs-target="#strukBelanjaModal"></i>
                            </h5>
                            <h4><strong id="total-tagihan">Rp<?php echo e(number_format(abs($uangKembali), 0, '', '.')); ?></strong>
                            </h4>
                            <?php elseif($order->jaminan < 0): ?> <h5 class="mt-2 text-danger"><strong>Total Hutang <i
                                        class="ri-information-line" style="cursor: pointer" data-bs-toggle="modal"
                                        data-bs-target="#strukBelanjaModal"></i></strong>
                                </h5>
                                <h4 class="text-danger"><strong
                                        id="total-tagihan">Rp<?php echo e(number_format(abs($order->jaminan), 0, '', '.')); ?></strong>
                                </h4>
                                <?php endif; ?>

                        </div>

                    </div>

                    <div class="choice-cntr mt-2">
                        <a class="btn btn-danger w-100 mb-2" href="#" role="button" data-bs-toggle="modal"
                            data-bs-target="#receivedModal">Barang Diterima</a>
                        <?php if($order->jaminan < 0): ?>
                            <button id="pay-button" class="btn btn-outline-danger w-100">Retur + Bayar Hutang Ongkir</button>
                        <?php else: ?>
                            <a class="btn btn-outline-danger w-100" href="#" role="button" data-bs-toggle="modal"
                            data-bs-target="#refundModal">Retur Barang</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Modal Diterima -->
    <div class="modal fade" id="receivedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Barang Diterima</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('terimaBarang', ['orderId' => $order->nomor_order])); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label for="formFile" class="form-label">Bukti Barang Diterima<span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile" name="bukti_diterima"
                            accept=".jpg,.png,.jpeg,.webp" required>
                        <div id="emailHelp" class="form-text text-danger">Pastikan gambar yang dikirim mencakup
                            seluruh
                            barang yang diterima!</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Refund -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan Refund</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('ajukanRefund', ['orderId' => $order->nomor_order])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p>Apakah kamu ingin mengajukan refund?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Struk Belanja -->
    <div class="modal fade" id="strukBelanjaModal" tabindex="-1" aria-labelledby="strukBelanjaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="strukBelanjaModalLabel">Struk Belanja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="w-100 mb-3">
                        <tr>
                            <td colspan="3" class="fw-bold text-center">Tagihan awal</td>
                        </tr>
                        <tr>
                            <td>Harga Katalog</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->harga_katalog, 0, '', '.')); ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Cuci</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->biaya_cuci ?? 0, 0, '', '.')); ?></td>
                        </tr>
                        <tr>
                            <td>Harga Additional</td>
                            <td class="text-end">:</td>
                            <?php if($order->additional): ?>
                            <?php $__currentLoopData = $order->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="text-end">Rp<?php echo e(number_format($additionalItem['harga'], 0, '', '.')); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <td class="text-end" id="harga-additional-total">Rp0</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Jaminan Ongkir</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp30.000</td>
                        </tr>
                        <tr>
                            <td>Jaminan Katalog</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp50.000</td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->fee_admin, 0, '', '.')); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total Tagihan</td>
                            <td class="text-end">:</td>
                            <td class="text-end fw-bold">Rp<?php echo e(number_format($order->grand_total, 0, '', '.')); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="fw-bold text-center">Ongkos Kirim dan Denda</td>
                        </tr>
                        <tr class="text-danger">
                            <td>Ongkos Kirim dari Toko</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->ongkir_pengiriman ?? 0, 0, '', '.')); ?></td>
                        </tr>
                        <tr class="text-danger">
                            <td>Denda Keterlambatan</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->denda_keterlambatan ?? 0, 0, '', '.')); ?>

                            </td>
                        </tr>
                        <tr class="text-danger">
                            <td>Denda Lain (Ex: Kerusakan)</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->denda_keterlambatan ?? 0, 0, '', '.')); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="fw-bold text-center">Sisa Jaminan</td>
                        </tr>
                        <tr>
                            <td>Jaminan Ongkir</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->ongkir_default ?? 0, 0, '', '.')); ?></td>
                        </tr>
                        <tr>
                            <td>Jaminan Kostum</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->jaminan ?? 0, 0, '', '.')); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="fw-bold text-center">Tagihan yang Belum Dibayar</td>
                        </tr>
                        <?php if($order->jaminan < 0): ?> <tr class="text-danger fw-bold">
                            <td>Hutang</td>
                            <td class="text-end">:</td>
                            <td class="text-end">Rp<?php echo e(number_format($order->jaminan ?? 0, 0, '', '.')); ?></td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td>Hutang</td>
                                <td class="text-end">:</td>
                                <td class="text-end">Rp0</td>
                            </tr>
                            <?php endif; ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        $.ajax({
            url: '<?php echo e(route('createSnapTokenDendaRetur', $order->nomor_order)); ?>',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
            },
            success: function(response) {
                console.log('Masuk');
                if (response.success) {
                    console.log('SUKSES RESPONSE NYA');
                    snap.pay(response.snap, {
                        onSuccess: function(result) {
                            $.ajax({
                                url: '<?php echo e(route('updatePenghasilanDendaRetur', $order->nomor_order)); ?>',
                                type: 'POST',
                                data: {
                                    _token: '<?php echo e(csrf_token()); ?>',
                                },
                                success: function(response) {
                                    if (response.success) {
                                        window.location.href = response.redirect_url;
                                    } else {
                                        alert(
                                            'Pembayaran berhasil, tetapi gagal memperbarui data toko.'
                                        );
                                    }
                                },
                                error: function() {
                                    alert(
                                        response.message
                                    );
                                }
                            });
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(
                                result, null, 2);
                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(
                                result, null, 2);
                        }
                    });
                } else {
                    if (response.message && response.message == 'terbayar') {
                        window.location.href = response.redirect_url;
                    } else {
                        alert('Terjadi kesalahan, mohon refresh halaman');
                    }
                }
            },
            error: function() {
                console.log(response);
                alert(
                    'Terjadi Kesahalah. Mohon Refresh halaman anda'
                );
            }
        });
    };
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\kalasewa hosting iterasi 3 v1\resources\views/penyewa/transaksi/detailPemesanan.blade.php ENDPATH**/ ?>