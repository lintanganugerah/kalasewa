<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-3 mt-3">
                <div>
                    <h1 class="fw-bold text-secondary">Dashboard Keuangan</h1>
                    <p class="fw-semibold text-secondary">Lihat Riwayat, saldo dan tarik penghasilan anda disini</p>
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="overflow: visible!important;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md">
                            <h4>Informasi Keuangan Anda</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex">
                                <p class="small mr-2">Total Penghasilan</p>
                                <div class="dropdown no-arrow small">
                                    <a class="dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span id="dropdown-text">Bulan Ini</span> <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Select Periode</div>
                                        <a class="dropdown-item bulan-select" data-periode="0"
                                            id="Januari-bulan">Januari</a>
                                        <a class="dropdown-item bulan-select" data-periode="1"
                                            id="Februari-bulan">Februari</a>
                                        <a class="dropdown-item bulan-select" data-periode="2" id="Maret-bulan">Maret</a>
                                        <a class="dropdown-item bulan-select" data-periode="3" id="April-bulan">April</a>
                                        <a class="dropdown-item bulan-select" data-periode="4" id="Mei-bulan">Mei</a>
                                        <a class="dropdown-item bulan-select" data-periode="5" id="Juni-bulan">Juni</a>
                                        <a class="dropdown-item bulan-select" data-periode="6" id="Juli-bulan">Juli</a>
                                        <a class="dropdown-item bulan-select" data-periode="7"
                                            id="Agustus-bulan">Agustus</a>
                                        <a class="dropdown-item bulan-select" data-periode="8"
                                            id="September-bulan">September</a>
                                        <a class="dropdown-item bulan-select" data-periode="9"
                                            id="Oktober-bulan">Oktober</a>
                                        <a class="dropdown-item bulan-select" data-periode="10"
                                            id="November-bulan">November</a>
                                        <a class="dropdown-item bulan-select" data-periode="11"
                                            id="Desember-bulan">Desember</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="info-keuangan" id="penghasilan-bulan">
                                <?php echo $__env->make('pemilikSewa.iterasi3.keuangan.penghasilan', [
                                    'penghasilanBulan' => $penghasilanBulan,
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </h5>
                        </div>
                        <div class="col">
                            <p class="small">Transaksi Berjalan</p>
                            <h5 class="info-keuangan">
                                Rp. <?php echo e(number_format($toko->saldo_tertunda(), 0, ',', '.')); ?>

                            </h5>
                        </div>
                        <div class="col">
                            <p class="small">Saldo dapat ditarik</p>
                            <h5 class="info-keuangan">
                                Rp. <?php echo e(number_format(auth()->user()->saldo_user->saldo ?? '0', 0, ',', '.')); ?>

                            </h5>
                        </div>
                        <div class="col">
                            <p class="small">Rekening Penarikan Anda</p>
                            <h5 class="info-keuangan">
                                <?php if(auth()->user()->saldo_user->nomor_rekening ?? false): ?>
                                    <?php echo e(auth()->user()->saldo_user->tujuanRekening->nama); ?> :
                                    <?php echo e(auth()->user()->saldo_user->nomor_rekening); ?>

                                <?php else: ?>
                                    xxx : xxxxxxxx
                                <?php endif; ?>
                                <a href="<?php echo e(route('seller.rekening.viewSetRekening')); ?>" class="small ml-2 btnRekening">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            </h5>
                        </div>
                        <div class="col align-self-center">
                            <a href="<?php echo e(route('seller.penarikan.viewTarikSaldo')); ?>" class="btn btn-danger">Tarik Saldo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('seller.keuangan.dashboardKeuangan')); ?>"
                            class="nav-link active text-secondary fw-bold">Penghasilan
                            dari pesanan</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('seller.penarikan.viewRiwayatPenarikan')); ?>"
                            class="nav-link text-secondary">Riwayat
                            Penarikan</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-more-tables tabel-data" id="series-table">
                            <thead>
                                <tr>
                                    <th>Nomor Order</th>
                                    <th>Produk</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Denda dari penyewa</th>
                                    <th>Additional</th>
                                    <th>Harga Sewa /3 hari</th>
                                    <th>Total Penghasilan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="series-table">
                                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-title="No Order" class="align-middle">
                                            <?php echo e($ord->nomor_order); ?></td>
                                        <td data-title="Produk" class="align-middle">
                                            <?php echo e($ord->id_produk_order->nama_produk); ?></td>
                                        <td data-title="Periode Sewa" class="align-middle">
                                            <?php echo e($ord->tanggalFormatted($ord->tanggal_mulai)); ?> <br> s.d
                                            <?php echo e($ord->tanggalFormatted($ord->tanggal_selesai)); ?>

                                        </td>
                                        <td data-title="Denda" class="align-middle">
                                            <?php echo e($ord->denda_keterlambatan ? 'Denda Keterlambatan : Rp.' . number_format($ord->denda_penyewa, 0, ',', '.') : 'Tidak Ada'); ?>

                                        </td>
                                        <td data-title="Additional" class="align-middle">
                                            <?php if($ord->additional): ?>
                                                <ul>
                                                    <?php $__currentLoopData = $ord->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($add['nama']); ?> +
                                                            <?php echo e(number_format($add['harga'], 0, '', '.')); ?>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                            <?php if($ord->id_produk_order->biaya_cuci): ?>
                                                <ul>
                                                    <li>Biaya cuci +
                                                        <?php echo e(number_format($ord->id_produk_order->biaya_cuci, 0, '', '.')); ?>

                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                        </td>
                                        <td data-title="Harga Sewa" class="align-middle">Rp.
                                            <?php echo e(number_format($ord->id_produk_order->harga, 0, ',', '.')); ?></td>
                                        <td data-title="Total Penghasilan" class="align-middle">
                                            <?php if(
                                                $ord->status == 'Menunggu di Proses' ||
                                                    $ord->status == 'Dalam Pengiriman' ||
                                                    $ord->status == 'Sedang Berlangsung' ||
                                                    $ord->status == 'Telah Kembali'): ?>
                                                Estimasi <br> Rp.
                                                <?php echo e(number_format($ord->total_penghasilan, 0, ',', '.')); ?>

                                                <p><a onclick="toggleModal()" class="text-danger  btnDetailPenghasilan"
                                                        data-namaproduk="<?php echo e($ord->produk->nama_produk); ?>"
                                                        data-dendapenyewa="<?php echo e($ord->denda_penyewa ?? 0); ?>"
                                                        data-dendaterlambat="<?php echo e($ord->denda_keterlambatan ?? 0); ?>"
                                                        data-dendaBelumLunas="<?php echo e($ord->dendaBelumLunas ?? 0); ?>"
                                                        data-hargaproduk="<?php echo e($ord->id_produk_order->harga); ?>"
                                                        data-additional="<?php echo e($ord->totalAdditional ?? 0); ?>"
                                                        data-biayacuci="<?php echo e($ord->biaya_cuci ?? 0); ?>"
                                                        data-ongkir="<?php echo e($ord->ongkir_pengiriman ?? 'Belum anda inputkan'); ?>"
                                                        data-totalharga="<?php echo e($ord->totalHargaPenyewaan ?? 0); ?>"
                                                        data-feeadmin="<?php echo e($ord->fee_admin); ?>"
                                                        data-hargaPenyewaanDanDenda="<?php echo e($ord->hargaPenyewaanDanDenda ?? 0); ?>"
                                                        data-totalpenghasilan="<?php echo e($ord->total_penghasilan); ?>">Lihat Detail
                                                        Penghasilan</a></p>
                                            <?php elseif($ord->status == 'Penyewaan Selesai'): ?>
                                                Rp.
                                                <?php echo e(number_format($ord->total_penghasilan, 0, ',', '.')); ?> <p><a
                                                        onclick="toggleModal()" class="text-danger  btnDetailPenghasilan"
                                                        data-namaproduk="<?php echo e($ord->produk->nama_produk); ?>"
                                                        data-dendapenyewa="<?php echo e($ord->denda_penyewa ?? 0); ?>"
                                                        data-dendaterlambat="<?php echo e($ord->denda_keterlambatan ?? 0); ?>"
                                                        data-dendaBelumLunas="<?php echo e($ord->dendaBelumLunas ?? 0); ?>"
                                                        data-hargaproduk="<?php echo e($ord->id_produk_order->harga); ?>"
                                                        data-additional="<?php echo e($ord->totalAdditional ?? 0); ?>"
                                                        data-biayacuci="<?php echo e($ord->biaya_cuci ?? 0); ?>"
                                                        data-ongkir="<?php echo e($ord->ongkir_pengiriman ?? 'Belum anda inputkan'); ?>"
                                                        data-totalharga="<?php echo e($ord->totalHargaPenyewaan ?? 0); ?>"
                                                        data-feeadmin="<?php echo e($ord->fee_admin); ?>"
                                                        data-hargaPenyewaanDanDenda="<?php echo e($ord->hargaPenyewaanDanDenda ?? 0); ?>"
                                                        data-totalpenghasilan="<?php echo e($ord->total_penghasilan); ?>">Lihat Detail
                                                        Penghasilan</a></p>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td data-title="Status" class="align-middle">
                                            <?php if($ord->status == 'Retur dalam Pengiriman'): ?>
                                                <a data-bs-toggle="modal" data-bs-target="#selesaikanPenyewaan-1"
                                                    class="d-grid btn btn-success mb-2" id="proses">Konfirmasi
                                                    Diterima</a>
                                            <?php elseif($ord->status == 'Retur'): ?>
                                                <p> Retur menunggu diproses oleh admin. Anda akan dikontak
                                                    admin mengenai retur ini melalui whatsapp</p>
                                            <?php elseif($ord->status == 'Retur Dikonfirmasi'): ?>
                                                <p> Retur dikonfirmasi. Menunggu dikirimkan
                                                    oleh penyewa</p>
                                            <?php else: ?>
                                                <?php echo e($ord->status); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailPenghasilan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penghasilan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Nama Produk :</h5>
                    <span id="modal_namaproduk"></span>

                    <h5 class="mt-3">Detail Penghasilan :</h5>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Produk / 3 hari</td>
                            <th> : </th>
                            <td id="modal_hargaproduk"></td>
                        </tr>
                        <tr>
                            <td>Total Additional</td>
                            <th> : </th>
                            <td id="modal_additional"></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Biaya Cuci</td>
                            <th> : </th>
                            <td id="modal_biayacuci"></td>
                        </tr>
                        <tr>
                            <td>Ongkir</td>
                            <th> : </th>
                            <td id="modal_ongkir"></td>
                        </tr>
                        <tr class="fw-bold">
                            <td>
                                Total Harga Penyewaan
                            </td>
                            <th> : </th>
                            <td id="modal_totalharga"></td>
                        </tr>
                        <tr>
                            <td>Denda Keterlambatan</td>
                            <th> : </th>
                            <td id="modal_dendaketerlambatan"></td>
                        </tr>
                        <tr>
                            <td>Denda Keterlambatan Belum Lunas</td>
                            <th> : </th>
                            <td id="modal_dendaBelumLunas"></td>
                        </tr>
                        <tr>
                            <td>Denda Lainnya Berdasarkan Peraturan anda (Ex: Kerusakan Kostum)</td>
                            <th> : </th>
                            <td id="modal_dendapenyewa"></td>
                        </tr>
                        <tr class="fw-bold">
                            <td>
                                Total Harga Penyewaan + Denda
                            </td>
                            <th> : </th>
                            <td id="modal_hargaPenyewaanDanDenda"></td>
                        </tr>
                        <tr>
                            <td>Dikurang Fee Admin (5%)</td>
                            <th> : </th>
                            <td id="modal_feeadmin"></td>
                        </tr>
                        <tr class="fw-bold">
                            <td>
                                Total Penghasilan Bersih
                            </td>
                            <th> : </th>
                            <td id="modal_totalpenghasilan"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-kalasewa" data-bs-dismiss="modal">Close</button>
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

        function toggleModal() {
            const namaproduk = event.srcElement.getAttribute('data-namaproduk');
            const dendaketerlambatan = event.srcElement.getAttribute('data-dendaterlambat');
            const dendaBelumLunas = event.srcElement.getAttribute('data-dendaBelumLunas');
            const dendapenyewa = event.srcElement.getAttribute('data-dendapenyewa');
            const hargaproduk = event.srcElement.getAttribute('data-hargaproduk');
            const additional = event.srcElement.getAttribute('data-additional');
            const biayacuci = event.srcElement.getAttribute('data-biayacuci');
            const ongkir = event.srcElement.getAttribute('data-ongkir');
            const feeadmin = event.srcElement.getAttribute('data-feeadmin');
            const totalpenghasilan = event.srcElement.getAttribute('data-totalpenghasilan');
            const totalharga = event.srcElement.getAttribute('data-totalharga');
            const hargaPenyewaanDanDenda = event.srcElement.getAttribute('data-hargaPenyewaanDanDenda');
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            document.getElementById('modal_dendapenyewa').textContent = formatter.format(dendapenyewa) +
                ' (Hanya yang lunas)';
            document.getElementById('modal_namaproduk').textContent = namaproduk;
            document.getElementById('modal_hargaproduk').textContent = formatter.format(hargaproduk);
            document.getElementById('modal_additional').textContent = formatter.format(additional);
            document.getElementById('modal_biayacuci').textContent = formatter.format(biayacuci);
            document.getElementById('modal_feeadmin').textContent = formatter.format(feeadmin);
            document.getElementById('modal_dendaketerlambatan').textContent = formatter.format(dendaketerlambatan);
            document.getElementById('modal_dendaBelumLunas').textContent = formatter.format(dendaBelumLunas);
            document.getElementById('modal_hargaPenyewaanDanDenda').textContent = formatter.format(hargaPenyewaanDanDenda);
            document.getElementById('modal_totalpenghasilan').textContent = formatter.format(totalpenghasilan);
            document.getElementById('modal_totalharga').textContent = formatter.format(totalharga);
            if (ongkir == "Belum anda inputkan") {
                document.getElementById('modal_ongkir').textContent = "Belum anda masukan biaya pengiriman";
            } else {
                document.getElementById('modal_ongkir').textContent = formatter.format(ongkir);
            }
            $('#modalDetailPenghasilan').modal('show');

            // if (bodyCardDetail.classList.contains('collapse') && bodyCardDetail.classList.contains('show')) {
            //     bodyCardDetail.classList.remove('show');
            //     bodyCardDetail.classList.add('collapsing');
            //     icon.classList.add('fa-chevron-down');
            //     icon.classList.remove('fa-chevron-up');
            // } else if (bodyCardDetail.classList.contains('collapsing')) {
            //     bodyCardDetail.classList.remove('collapsing');
            //     bodyCardDetail.classList.add('collapse');
            //     bodyCardDetail.classList.add('show');
            //     icon.classList.remove('fa-chevron-down');
            //     icon.classList.add('fa-chevron-up');
            // }
        }

        console.log('masuk')
        var bulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        var now = new Date();
        var bulanSekarang = bulan[now.getMonth()]; //Ambil bulan sesuai dengan index bulan yang didapat skrg
        var dropdownItems = document.querySelectorAll('.dropdown-item.bulan-select');
        var dropdownTeks = document.getElementById('dropdown-text');

        dropdownItems.forEach(function(item) {
            if (bulan[item.dataset.periode] == bulanSekarang) {
                dropdownTeks.textContent = bulan[item.dataset.periode];
                item.classList.add('active');
            }
        });
        $('.bulan-select').on('click', function(e) {
            var periode = $(this).data('periode');
            var url = `/keuangan-bulan/${periode}`;

            // Ubah class active pada dropdown
            $('.bulan-select').removeClass('active');
            $(this).addClass('active');

            // Ubah teks dropdown
            $('#dropdown-text').text(bulan[periode]);

            // Ambil data dari controller
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#penghasilan-bulan').html(response);
                },
                error: function(xhr, status, error) {
                    console.log('error');
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi3/keuangan/dashboardKeuangan.blade.php ENDPATH**/ ?>