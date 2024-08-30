<?php $__env->startSection('content'); ?>

    <style>
        .no-underline {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
            /* Inherit the color from the parent element or set it explicitly */
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 2em;
            color: #d3d3d3;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label {
            color: #ffca08;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffca08;
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
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?>

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
                                    <a class="nav-link active" aria-current="page" href="<?php echo e(route('viewHistorySedangBerlangsung')); ?>">Sedang
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
                                                <th>Toko</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Total Biaya</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($order->status == 'Sedang Berlangsung'): ?>
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
                                                        <td><?php echo e($order->nama_toko); ?></td>
                                                        <td><?php echo e($order->tanggal_mulai); ?></td>
                                                        <td><?php echo e($order->tanggal_selesai); ?></td>
                                                        <td>Rp<?php echo e(number_format($order->grand_total, 0, '', '.')); ?></td>
                                                        <td>
                                                            <?php if($order->status == 'Sedang Berlangsung'): ?>
                                                                <?php if($order->jaminan < 0 && $order->denda_keterlambatan > 0): ?>
                                                                    Kamu terlambat mengembalikan kostum, silahkan bayar denda terlebih dahulu!
                                                                <?php elseif($order->jaminan < 0 && $order->ongkir_default == 0): ?>
                                                                    Jaminan ongkir kamu tidak tercukupi. silahkan bayar ongkos kirim yang kurang!
                                                                <?php else: ?>
                                                                    Sedang Digunakan
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($order->jaminan < 0): ?>
                                                                <a href="<?php echo e(route('viewPengembalianBarang', ['orderId' => $order->nomor_order])); ?>"
                                                                    class="btn btn-danger w-100">Bayar</a>
                                                            <?php else: ?>
                                                                <a class="btn btn-danger w-100" href="#" role="button" data-bs-toggle="modal"
                                                                    data-bs-target="#returModal-<?php echo e($loop->iteration); ?>">Kembalikan Barang</a>
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
                                                                    <img src="<?php echo e(asset($order->bukti_resi)); ?>" alt="Resi" class="img-fluid">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Retur -->
                                                    <div class="modal fade" id="returModal-<?php echo e($loop->iteration); ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel-<?php echo e($loop->iteration); ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Retur Barang
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="<?php echo e(route('returBarang', ['orderId' => $order->nomor_order])); ?>" method="POST"
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

                                                                        <hr>

                                                                        <div class="rating-kostum mt-2">
                                                                            <label for="rating-kostum" class="form-label">Rating
                                                                                Kostum<span class="text-danger">*</span></label><br>
                                                                            <div class="star-rating">
                                                                                <input type="radio" name="rating" id="star5" value="5"><label for="star5"
                                                                                    title="Nilai 5">&#9733;</label>
                                                                                <input type="radio" name="rating" id="star4" value="4"><label for="star4"
                                                                                    title="Nilai 4">&#9733;</label>
                                                                                <input type="radio" name="rating" id="star3" value="3"><label for="star3"
                                                                                    title="Nilai 3">&#9733;</label>
                                                                                <input type="radio" name="rating" id="star2" value="2"><label for="star2"
                                                                                    title="Nilai 2">&#9733;</label>
                                                                                <input type="radio" name="rating" id="star1" value="1"><label for="star1"
                                                                                    title="Nilai 1">&#9733;</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="ulasan-kostum mt-2">
                                                                            <label for="exampleInputEmail1" class="form-label">Ulasan
                                                                                Kostum<span class="text-danger">*</span></label>
                                                                            <textarea name="ulasankostum" placeholder="Ulasan Kostum yang Dirental" class="form-control form-control-lg w-100" required></textarea>
                                                                            <div id="emailHelp" class="form-text">Silahkan
                                                                                tuliskan
                                                                                ulasan anda terhadap kostum yang anda
                                                                                rental!</div>
                                                                        </div>
                                                                        <div class="dokumentasi-kostum mt-2">
                                                                            <label for="formFile" class="form-label">Tambahkan
                                                                                Foto Testimoni</label>
                                                                            <input class="form-control" type="file" id="formFile" name="dokumentasi_kostum[]"
                                                                                accept=".jpg,.png,.jpeg" multiple>
                                                                            <div id="imageContainer" class="rounded mt-3">
                                                                            </div>
                                                                            <div id="emailHelp" class="form-text">Gambar
                                                                                bisa lebih dari
                                                                                1</div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.star-rating input');
                stars.forEach(star => {
                    star.addEventListener('change', function() {
                        const ratingValue = this.value;
                        console.log(`Rated: ${ratingValue} stars`);
                        // You can add more code here to handle the rating value
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.querySelector('input[type="file"][name="dokumentasi_kostum[]"]');
                const imageContainer = document.getElementById('imageContainer');

                fileInput.addEventListener('change', function(event) {
                    const files = event.target.files;
                    imageContainer.innerHTML = ''; // Clear previous images

                    Array.from(files).forEach(file => {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('img-thumbnail');
                            img.style.width = '100px'; // Adjust size as needed
                            img.style.marginRight = '10px';
                            imageContainer.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>


    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/history/sedangberlangsung.blade.php ENDPATH**/ ?>