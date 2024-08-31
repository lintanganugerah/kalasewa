<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/detail.css')); ?>" />

    <section>

        <style>
            .carousel-item {
                transition-duration: 0.3s !important;
                /* 300 milliseconds */
            }

            .no-underline {
                text-decoration: none;
                /* Remove underline */
                color: inherit;
                /* Inherit the color from the parent element or set it explicitly */
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                background-color: rgba(0, 0, 0, 0.7);
                padding: 10px;
                border-radius: 10%;
            }
        </style>

        <div class="container mt-2 mb-3">
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

        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="carousel-container">
                            <div id="carouselExampleIndicators" class="carousel slide">
                                <div class="carousel-indicators">
                                    <?php $__currentLoopData = $fotoproduk->where('id_produk', $produk->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($index); ?>"
                                            class="<?php echo e($index == 0 ? 'active' : ''); ?>" aria-current="<?php echo e($index == 0 ? 'true' : 'false'); ?>"
                                            aria-label="Slide <?php echo e($index + 1); ?>"></button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="carousel-inner">
                                    <?php $__currentLoopData = $fotoproduk->where('id_produk', $produk->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item-detail carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                            <img src="<?php echo e(asset($foto->path)); ?>" class="d-block w-100" alt="<?php echo e($produk->nama_produk); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="carousel-thumbnail">
                            <div class="row mt-3">
                                <div class="d-flex flex-wrap">
                                    <?php $__currentLoopData = $fotoproduk->where('id_produk', $produk->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="p-1">
                                            <div class="thumbnail-container" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($index); ?>">
                                                <img src="<?php echo e(asset($foto->path)); ?>" class="img-thumbnail thumbnail-image" alt="<?php echo e($produk->nama_produk); ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-start">
                        <h1><strong><?php echo e($produk->nama_produk); ?></strong></h1>
                        <h3 style="color: orange;"><strong>Rp<?php echo e(number_format($produk->harga, 0, '', '.')); ?> / 3
                                Hari</strong></h3>
                        <p>Rating:
                            <?php if($averageRating): ?>
                                <?php echo e(number_format($averageRating, 1)); ?>

                            <?php else: ?>
                                Belum ada rating
                            <?php endif; ?>
                        </p>

                        <hr>

                        <h3 class="mt-2"><strong>KETERANGAN KOSTUM</strong></h3>
                        <button type="button" class="btn btn-outline-dark mb-2">Size:
                            <?php echo e($produk->ukuran_produk); ?></button>
                        <button type="button" class="btn btn-outline-dark mb-2"><?php echo e($produk->grade); ?></button>
                        <?php if($produk->brand): ?>
                            <button type="button" class="btn btn-outline-dark mb-2">Costume Brand:
                                <?php echo e($produk->brand); ?></button>
                        <?php endif; ?>
                        <?php if($produk->brand_wig): ?>
                            <button type="button" class="btn btn-outline-dark mb-2">Wig Brand:
                                <?php echo e($produk->brand_wig); ?></button>
                        <?php endif; ?>
                        <?php if($produk->keterangan_wig): ?>
                            <button type="button" class="btn btn-outline-dark mb-2">Wig Styling:
                                <?php echo e($produk->keterangan_wig); ?></button>
                        <?php endif; ?>
                        <?php if($produk->biaya_cuci): ?>
                            <button type="button" class="btn btn-outline-dark mb-2">Biaya Cuci:
                                Rp<?php echo e(number_format($produk->biaya_cuci, 0, '', '.')); ?></button>
                        <?php endif; ?>

                        <h3 class="mt-4"><strong>PILIHAN ADDITIONAL</strong></h3>
                        <?php if($produk->additional): ?>
                            <?php $__currentLoopData = json_decode($produk->additional, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $harga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="btn btn-outline-dark"><?php echo e($nama); ?></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p>Maaf, Produk ini tidak memiliki additional</p>
                        <?php endif; ?>
                        <h3 class="mt-4"><strong>DESKRIPSI KOSTUM</strong></h3>
                        <p><?php echo nl2br(e($produk->deskripsi_produk)); ?></p>

                        <hr>

                        <h3 class="text-center text-decoration-underline mt-4"><strong>ATURAN TOKO</strong></h3>

                        <table>
                            <tr>
                                <th>Nama Peraturan</th>
                                <th>Deskripsi</th>
                                <th>Denda</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $aturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($atur->nama); ?></td>
                                        <td><?php echo e($atur->deskripsi); ?></td>
                                        <?php if($atur->terdapat_denda): ?>
                                            <?php if($atur->denda_pasti): ?>
                                                <td data-title="Denda" class="align-middle">
                                                    Rp<?php echo e(number_format($atur->denda_pasti, 0, '', '.')); ?>

                                                </td>
                                            <?php else: ?>
                                                <td data-title="Denda" class="align-middle">
                                                    <?php echo e($atur->denda_kondisional); ?>

                                                </td>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <td data-title="Denda" class="align-middle">-
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <div class="container">
                                <div class="card-body text-center">
                                    <?php if($produk->toko && $produk->toko->user): ?>
                                        <img class="avatar-img" src="<?php echo e(asset($produk->toko->user->foto_profil)); ?>" alt="User" style="border-radius: 30px; width: 60px;" />
                                        <a href="<?php echo e(route('viewToko', ['id' => $produk->toko->id])); ?>" class="no-underline">
                                            <h5 class="card-title text-center">
                                                <strong><?php echo e($produk->toko->nama_toko); ?></strong>
                                            </h5>
                                        </a>
                                    <?php endif; ?>
                                    <div class="container-fluid d-flex justify-content-around">
                                        <i class="ri-star-line">
                                            <?php if($averageTokoRating): ?>
                                                <?php echo e(number_format($averageTokoRating, 1)); ?>

                                            <?php else: ?>
                                                0
                                            <?php endif; ?>
                                        </i>
                                        <?php if($averageTokoRating >= 4): ?>
                                            <span class="badge text-white" style="background: linear-gradient(to right, #EAD946, #D99C00);">Terpercaya</span>
                                        <?php elseif($averageTokoRating > 0 && $averageTokoRating < 2.5): ?>
                                            <span class="badge text-bg-danger">
                                                Bermasalah</span>
                                        <?php elseif($averageTokoRating >= 2.5 && $averageTokoRating < 4): ?>
                                            <span class="badge text-white" style="background-color: #EB7F01;">Standar</span>
                                        <?php else: ?>
                                            <span class="badge text-white" style="background-color: 6DC0D0;">
                                                Pendatang</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card-text text-start mt-2"><?php echo nl2br(e($produk->toko->bio_toko)); ?></p>
                                    <div class="pilihan-user mt-2">
                                        <?php if(auth()->check() && auth()->user()->role === 'penyewa'): ?>
                                            <div class="col">
                                                <?php if($produk->status_produk == 'tidak ready'): ?>
                                                    <button type="submit" class="btn btn-danger w-100" disabled>Rental
                                                        Produk</button>
                                                    <p>Produk ini sedang dirental!</p>
                                                <?php else: ?>
                                                    <form action="<?php echo e(route('viewOrder', ['id' => $produk->id])); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php if($produk->grade == 'Grade 3' && auth()->user()->total_review_penyewa() >= 3 && auth()->user()->avg_nilai_penyewa() >= 4): ?>
                                                            <button type="submit" class="btn btn-danger w-100">Rental
                                                                Produk</button>
                                                        <?php elseif($produk->grade == 'Grade 2' && auth()->user()->total_review_penyewa() > 0): ?>
                                                            <button type="submit" class="btn btn-danger w-100">Rental
                                                                Produk</button>
                                                        <?php elseif($produk->grade == 'Grade 1'): ?>
                                                            <button type="submit" class="btn btn-danger w-100">Rental
                                                                Produk</button>
                                                        <?php else: ?>
                                                            <button type="submit" class="btn btn-danger w-100" disabled>Rental
                                                                Produk</button>
                                                            <span>Mengapa saya tidak bisa menyewa produk ini<a data-bs-toggle="modal" data-bs-target="#infoModalGrade"><i
                                                                        class="fa-solid fa-regular fa-circle-info ms-2"></i></a></span>
                                                        <?php endif; ?>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col">
                                                <?php if($produk->isInWishlist()): ?>
                                                    <form action="<?php echo e(route('wishlist.remove', ['id' => $produk->id])); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-danger w-100">Hapus
                                                            Wishlist</button>
                                                    </form>
                                                <?php else: ?>
                                                    <form action="<?php echo e(route('wishlist.add', ['id' => $produk->id])); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-outline-danger w-100">Tambah
                                                            Wishlist</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo e(url('/chat' . '/' . $produk->toko->id_user)); ?>" target="_blank" class="no-underline"><button type="button"
                                                        class="btn btn-outline-success w-100">Chat Toko</button></a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col my-2">
                                                <button type="button" class="btn btn-danger w-100" disabled>Rental
                                                    Produk</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-outline-danger w-100" disabled>Tambahkan
                                                    Wishlist</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-outline-success mt-2 w-100" disabled>Chat
                                                    Toko</button>
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

        <div class="container-fluid mt-5">
            <div class="container">
                <hr>
                <h1 class="mb-3"><strong>Review Produk</strong></h1>
                <div class="card">
                    <div class="card-body">
                        <table class="table w-100" id="review-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Komentar</th>
                                    <th>Nilai</th>
                                    <th class="text-end">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($rev->user->nama); ?></td>
                                        <td><?php echo e($rev->komentar); ?></td>
                                        <td>
                                            <?php for($i = 0; $i < $rev->nilai; $i++): ?>
                                                <i class="ri-star-fill"></i>
                                            <?php endfor; ?>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo e($loop->index); ?>">
                                                Lihat Foto Review
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-6">
                        <h1><strong>Lainnya dari <?php echo e($produk->toko->nama_toko); ?></strong></h1>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?php echo e(route('viewToko', ['id' => $produk->toko->id])); ?>" class="no-underline">
                            <button class="btn btn-outline-danger mb-2">Lihat Semua</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <div class="row-kartu d-flex mb-3">
                    <?php $__currentLoopData = $produkLain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-2" style="margin-right: 43px;">
                            <a href="<?php echo e(route('viewDetail', ['id' => $prod->id])); ?>" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                                    <?php $__currentLoopData = $fotoProdukLain->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk" style="object-fit: cover;">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar avatar-card me-2">
                                                <img class="avatar-img" src="<?php echo e(asset($prod->toko->user->foto_profil)); ?>" alt="User" style="border-radius: 30px;" />
                                            </div>
                                            <div class="fs-08-rem user-card">
                                                <?php $__currentLoopData = $toko->where('id', $prod->id_toko)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="fw-bold text-truncate">
                                                        <?php echo e($tk->nama_toko); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <h5 class="card-title" style="margin-bottom: 2px;"><?php echo e($prod->nama_produk); ?></h5>
                                        <p class="card-text" style="color: orange;">
                                            <strong>Rp<?php echo e(number_format($prod->harga)); ?>

                                                / 3 Hari</strong>
                                        </p>
                                        <p class="card-text">
                                            <img src="<?php echo e(asset('storage/icon/box-seam.png')); ?>" alt="box-seam"
                                                style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                            <?php echo e($prod->brand); ?>

                                        </p>
                                        <p class="card-text">
                                            <img src="<?php echo e(asset('storage/icon/tv.png')); ?>" alt="tv" style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                            <?php echo e($prod->seriesDetail->series); ?>

                                        </p>
                                        <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                            <?php echo e($prod->ukuran_produk); ?>

                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                            <?php echo e($prod->gender); ?>

                                        </button>
                                        <?php if($prod->additional): ?>
                                            <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                                +Additional
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-6">
                        <h1><strong><?php echo e($produk->SeriesDetail->series); ?></strong></h1>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?php echo e(route('viewPencarian', ['id_series' => $produk->id_series])); ?>" class="no-underline">
                            <button class="btn btn-outline-danger mb-2">Lihat Semua</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <div class="row-kartu d-flex mb-3">
                    <?php $__currentLoopData = $produkSeriesSama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-2" style="margin-right: 43px;">
                            <a href="<?php echo e(route('viewDetail', ['id' => $prod->id])); ?>" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                                    <?php $__currentLoopData = $fotoProdukLain->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk" style="object-fit: cover;">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar avatar-card me-2">
                                                <img class="avatar-img" src="<?php echo e(asset($prod->toko->user->foto_profil)); ?>" alt="User" style="border-radius: 30px;" />
                                            </div>
                                            <div class="fs-08-rem user-card">
                                                <?php $__currentLoopData = $toko->where('id', $prod->id_toko)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="fw-bold text-truncate">
                                                        <?php echo e($tk->nama_toko); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <h5 class="card-title" style="margin-bottom: 2px;"><?php echo e($prod->nama_produk); ?></h5>
                                        <p class="card-text" style="color: orange;">
                                            <strong>Rp<?php echo e(number_format($prod->harga)); ?>

                                                / 3 Hari</strong>
                                        </p>
                                        <p class="card-text">
                                            <img src="<?php echo e(asset('storage/icon/box-seam.png')); ?>" alt="box-seam"
                                                style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                            <?php echo e($prod->brand); ?>

                                        </p>
                                        <p class="card-text">
                                            <img src="<?php echo e(asset('storage/icon/tv.png')); ?>" alt="tv" style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                            <?php echo e($prod->seriesDetail->series); ?>

                                        </p>
                                        <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                            <?php echo e($prod->ukuran_produk); ?>

                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                            <?php echo e($prod->gender); ?>

                                        </button>
                                        <?php if($prod->additional): ?>
                                            <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                                +Additional
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal-<?php echo e($index); ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo e($index); ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel-<?php echo e($index); ?>">Review
                                <?php echo e($rev->user->nama); ?>

                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if($rev->foto): ?>
                                <?php $__currentLoopData = json_decode($rev->foto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img class="rounded img-fluid mb-3" src="<?php echo e(asset($foto)); ?>" alt="Review <?php echo e($rev->user->nama); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p> Tidak ada Foto Review </p>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- Modal Grade -->
        <div class="modal fade" id="infoModalGrade" tabindex="-1" aria-labelledby="infoModalGradeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalGradeLabel">Informasi Grade Kostum</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if(auth()->user()): ?>
                            <span class='text-danger'>
                                <p class="fw-bold">Keterangan Akun</p>
                                <p>Sejauh ini, anda memiliki rating sebesar:
                                    <strong><?php echo e(number_format(auth()->user()->avg_nilai_penyewa(), 2)); ?></strong> <br>dan
                                    baru
                                    pernah
                                    menyewa sebanyak:
                                    <strong><?php echo e(number_format(auth()->user()->total_review_penyewa())); ?>x</strong>
                                </p>
                                <p>Kostum ini memiliki <strong><?php echo e($produk->grade); ?></strong></p>
                            </span>
                        <?php endif; ?>

                        <p class="fw-bold">Apa Itu Grade Kostum ?</p>
                        <p>Sistem grade digunakan untuk membedakan kostum-kostum berdasarkan tingkat
                            kompleksitas, kualitas, dan harga, serta untuk menentukan siapa yang memenuhi syarat
                            untuk menyewa setiap grade kostum tersebut.</p>

                        <p><span class="fw-bold">Jika penyewa
                                tidak memenuhi syarat,
                                maka ia tidak akan bisa merental kostum tersebut.</span> Berikut adalah
                            penjelasan mengenai
                            sistem grade yang kami terapkan:</p>

                        <p class="fw-bold">Grade 1</p>
                        <ul>
                            <li><span class="fw-bold">Syarat Penyewa :</span> Dapat disewa oleh siapa saja,
                                termasuk penyewa baru atau newbie.
                            </li>
                        </ul>
                        <p class="fw-bold">Grade 2</p>
                        <ul>
                            <li><span class="fw-bold">Syarat Penyewa :</span> Hanya bisa disewa oleh pelanggan
                                yang sudah memiliki pengalaman menyewa minimal 1x di kalasewa sebelumnya.
                            </li>
                        </ul>

                        <p class="fw-bold">Grade 3</p>
                        <ul>
                            <li><span class="fw-bold">Syarat Penyewa :</span> Hanya bisa disewa oleh pelanggan
                                yang sudah memiliki pengalaman menyewa di kalasewa sebelumnya sebanyak 3x, dan
                                penyewa memiliki
                                rating review setidaknya 4.
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/detail.blade.php ENDPATH**/ ?>