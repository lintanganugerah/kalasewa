<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Produk</h1>
                <h4 class="fw-semibold text-secondary">Manajemen Produk Anda disini</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item fw-bold" role="presentation">
                                <button class="nav-link active text-secondary fw-bold" id="Produkanda-tab"
                                    data-bs-toggle="tab" onclick="window.location.href='/produk/produkanda'" type="button"
                                    role="tab" aria-controls="Produkanda" aria-selected="true">Produk
                                    Anda</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Tambah
                                    Produk</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
                                <h5 class="card-title">Produk Aktif</h5>
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
                                <div class="row row-cols-1 row-cols-md-4 g-4">
                                    <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($prod->status_produk == 'aktif'): ?>
                                            <div class="col mb-4">
                                                <div class="card h-100">
                                                    <div class="p-3">
                                                        <div class="image-container">
                                                            <img src="<?php echo e(asset($prod->getFotoProdukFirst($prod->id)->path)); ?>" class="card-img-top" alt="...">
                                                        </div>
                                                        <div class="product-details mt-3">
                                                            <h5 class="card-title fw-bolder fs-5"><?php echo e($prod->nama_produk); ?>

                                                            </h5>
                                                            <p class="cut-text fw-bold fs-6">Rp
                                                                <?php echo e(number_format($prod->harga, 0, '', '.')); ?> / 3 hari</p>
                                                            <p class="cut-text"><?php echo e($prod->brand); ?>, <?php echo e($prod->gender); ?>,
                                                                <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($sr->id == $prod->id_series): ?>
                                                                        <?php echo e($sr->series); ?>

                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                            <p class="mb-1">Ukuran : <?php echo e($prod->ukuran_produk); ?></p>
                                                            <p class="mb-1">Grade : <?php echo e($prod->grade); ?></p>
                                                            <?php if($prod->brand_wig && $prod->keterangan_wig): ?>
                                                                <p class="mb-1">Wig : <?php echo e($prod->brand_wig); ?>

                                                                    (<?php echo e($prod->keterangan_wig); ?>)
                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Wig : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->biaya_cuci): ?>
                                                                <p class="mb-1">Biaya Cuci : Rp
                                                                    <?php echo e(number_format($prod->biaya_cuci, 0, '', '.')); ?></p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Biaya Cuci : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->id_alamat): ?>
                                                                <p class="mb-1">Lokasi Produk: <?php echo e($prod->alamat->nama); ?>

                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Lokasi Produk: Alamat Utama</p>
                                                            <?php endif; ?>
                                                            <p class="mb-1">Metode Kirim :</p>
                                                            <ul>
                                                                <?php $__currentLoopData = json_decode($prod->metode_kirim); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($metode); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <?php if($prod->additional): ?>
                                                                <p>Additional :</p>
                                                                <ul>
                                                                    <?php $__currentLoopData = json_decode($prod->additional, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $harga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>Add <?php echo e($nama); ?> + Rp
                                                                            <?php echo e(number_format($harga, 0, '', '.')); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <p>Additional : Tidak ada</p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="d-flex mt-auto flex-wrap">
                                                            <a href="<?php echo e(route('seller.viewEditProduk', $prod->id)); ?>"
                                                                class="btn btn-primary d-grid mb-2 me-2">Edit</a>
                                                            <form action="<?php echo e(route('seller.arsipProduk', $prod->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit"
                                                                    class="btn btn-primary d-grid mb-2 me-2">Arsipkan</button>
                                                            </form>
                                                            <form action="<?php echo e(route('seller.hapusProduk', $prod->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit"
                                                                    class="btn btn-danger d-grid mb-2 me-2"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($produk->where('status_produk', 'aktif')->isEmpty()): ?>
                                        <div class="col">
                                            <div class="text-secondary fw-light opacity-50">Buat produk baru atau klik
                                                Aktifkan pada produk untuk menampilkan nya disini</div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <hr class="bg-secondary border-5 border-top border-secondary mb-5" />
                                <h5 class="card-title">Produk Diarsipkan (Tidak ditampilkan pada marketplace)</h5>
                                <div class="row row-cols-1 row-cols-md-4 g-4">
                                    <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($prod->status_produk == 'arsip'): ?>
                                            <div class="col mb-4">
                                                <div class="card h-100">
                                                    <div class="p-3">
                                                        <div class="image-container">
                                                            <?php $__currentLoopData = $fotoProduk->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset($fp->path)); ?>" class="card-img-top"
                                                                    alt="...">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <div class="product-details mt-3">
                                                            <h5 class="card-title fw-bolder fs-5"><?php echo e($prod->nama_produk); ?>

                                                            </h5>
                                                            <p class="cut-text fw-bold fs-6">Rp
                                                                <?php echo e(number_format($prod->harga, 0, '', '.')); ?> / 3 hari</p>
                                                            <p class="cut-text"><?php echo e($prod->brand); ?>, <?php echo e($prod->gender); ?>,
                                                                <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($sr->id == $prod->id_series): ?>
                                                                        <?php echo e($sr->series); ?>

                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                            <p class="mb-1">Ukuran : <?php echo e($prod->ukuran_produk); ?></p>
                                                            <p class="mb-1">Grade : <?php echo e($prod->grade); ?></p>
                                                            <?php if($prod->brand_wig && $prod->keterangan_wig): ?>
                                                                <p class="mb-1">Wig : <?php echo e($prod->brand_wig); ?>

                                                                    (<?php echo e($prod->keterangan_wig); ?>)
                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Wig : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->biaya_cuci): ?>
                                                                <p class="mb-1">Biaya Cuci : Rp
                                                                    <?php echo e(number_format($prod->biaya_cuci, 0, '', '.')); ?></p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Biaya Cuci : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->id_alamat): ?>
                                                                <p class="mb-1">Lokasi Produk: <?php echo e($prod->alamat->nama); ?>

                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Lokasi Produk: Alamat Utama</p>
                                                            <?php endif; ?>
                                                            <p class="mb-1">Metode Kirim :</p>
                                                            <ul>
                                                                <?php $__currentLoopData = json_decode($prod->metode_kirim); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($metode); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <?php if($prod->additional): ?>
                                                                <p>Additional :</p>
                                                                <ul>
                                                                    <?php $__currentLoopData = json_decode($prod->additional, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $harga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>Add <?php echo e($nama); ?> + Rp
                                                                            <?php echo e(number_format($harga, 0, '', '.')); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <p>Additional : Tidak ada</p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($prod->LastOrder): ?>
                                                            <?php if(!$prod->LastOrder->ready_status): ?>
                                                                <hr>
                                                                <p class="cut-text fw-bold fs-6"> Informasi Order </p>
                                                                <small class="mb-3"> Produk ini sebelumnya telah disewa
                                                                    dan
                                                                    selesai. Sistem
                                                                    secara default mengarsipkan produk ini. <span
                                                                        class="fw-bold text-danger">Mohon
                                                                        klik "aktifkan" jika produk sudah ready </span> agar
                                                                    dapat
                                                                    disewa kembali </small>
                                                                <hr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <div class="d-flex mt-auto flex-wrap">
                                                            <a href="<?php echo e(route('seller.viewEditProduk', $prod->id)); ?>"
                                                                class="btn btn-primary d-grid mb-2 me-2">Edit</a>
                                                            <form action="<?php echo e(route('seller.aktifkanProduk', $prod->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit"
                                                                    class="btn btn-primary mb-2 me-2 d-grid">Aktifkan</button>
                                                            </form>
                                                            <form action="<?php echo e(route('seller.hapusProduk', $prod->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit"
                                                                    class="btn btn-danger d-grid mb-2 me-2"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($produk->where('status_produk', 'arsip')->isEmpty()): ?>
                                        <div class="col">
                                            <div class="text-secondary fw-light opacity-50">Anda Belum Memiliki Produk yang
                                                diarsipkan. Klik Arsipkan pada Produk untuk menonaktifkan dari marketplace
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                
                                <hr class="bg-secondary border-5 border-top border-secondary mb-5" />
                                <h5 class="card-title">Produk Yang Sedang Disewa</h5>
                                <div class="row row-cols-1 row-cols-md-4 g-4">
                                    <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($prod->status_produk == 'tidak ready'): ?>
                                            <div class="col mb-4">
                                                <div class="card h-100">
                                                    <div class="p-3">
                                                        <div class="image-container">
                                                            <?php $__currentLoopData = $fotoProduk->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset($fp->path)); ?>" class="card-img-top"
                                                                    alt="...">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <div class="product-details mt-3">
                                                            <h5 class="card-title fw-bolder fs-5"><?php echo e($prod->nama_produk); ?>

                                                            </h5>
                                                            <p class="cut-text fw-bold fs-6">Rp
                                                                <?php echo e(number_format($prod->harga, 0, '', '.')); ?> / 3 hari</p>
                                                            <p class="cut-text"><?php echo e($prod->brand); ?>, <?php echo e($prod->gender); ?>,
                                                                <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($sr->id == $prod->id_series): ?>
                                                                        <?php echo e($sr->series); ?>

                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                            <p class="mb-1">Ukuran : <?php echo e($prod->ukuran_produk); ?></p>
                                                            <p class="mb-1">Grade : <?php echo e($prod->grade); ?></p>
                                                            <?php if($prod->brand_wig && $prod->keterangan_wig): ?>
                                                                <p class="mb-1">Wig : <?php echo e($prod->brand_wig); ?>

                                                                    (<?php echo e($prod->keterangan_wig); ?>)
                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Wig : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->biaya_cuci): ?>
                                                                <p class="mb-1">Biaya Cuci : Rp
                                                                    <?php echo e(number_format($prod->biaya_cuci, 0, '', '.')); ?></p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Biaya Cuci : Tidak ada</p>
                                                            <?php endif; ?>
                                                            <?php if($prod->id_alamat): ?>
                                                                <p class="mb-1">Lokasi Produk: <?php echo e($prod->alamat->nama); ?>

                                                                </p>
                                                            <?php else: ?>
                                                                <p class="mb-1">Lokasi Produk: Alamat Utama</p>
                                                            <?php endif; ?>
                                                            <p class="mb-1">Metode Kirim :</p>
                                                            <ul>
                                                                <?php $__currentLoopData = json_decode($prod->metode_kirim); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($metode); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <?php if($prod->additional): ?>
                                                                <p>Additional :</p>
                                                                <ul>
                                                                    <?php $__currentLoopData = json_decode($prod->additional, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $harga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>Add <?php echo e($nama); ?> + Rp
                                                                            <?php echo e(number_format($harga, 0, '', '.')); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <p>Additional : Tidak ada</p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <hr>
                                                        <p class="cut-text fw-bold fs-6"> Informasi Order </p>
                                                        <p> Nomor Order : <?php echo e($prod->LastOrder->nomor_order); ?> </p>
                                                        <p> Disewa oleh : <?php echo e($prod->LastOrder->user->nama); ?> </p>
                                                        <p> Status Order : <?php echo e($prod->LastOrder->status); ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($produk->where('status_produk', 'tidak ready')->isEmpty()): ?>
                                        <div class="col">
                                            <div class="text-secondary fw-light opacity-50 mb-5">Tidak ada
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap JS (Optional, if you need Bootstrap JS features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/produk/produkanda.blade.php ENDPATH**/ ?>