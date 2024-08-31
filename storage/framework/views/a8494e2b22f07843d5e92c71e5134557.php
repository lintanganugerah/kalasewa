<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/searchbar.css')); ?>" />

    <section>
        <style>
            .no-underline {
                text-decoration: none;
                /* Remove underline */
                color: inherit;
                /* Inherit the color from the parent element or set it explicitly */
            }

            .select2-container .select2-selection--single .select2-selection__clear {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                padding-right: 150%;
                cursor: pointer;
            }
        </style>
        <div class="container-fluid mt-3 align-items-center">
            <div class="container">
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
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-7">
                                <div class="hero mt-5">
                                    <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="Logo Kalasewa" style="width: 150px; height: 150px;">
                                    <h1><strong>KALASEWA</strong></h1>
                                    <h4>Ayo mulai wujudkan impian cosplaymu<br>bersama Kalasewa</h4>
                                </div>
                            </div>
                            <div class="col-5">
                                <div id="carouselExampleAutoplaying" class="carousel slide w-100 text-end" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="object-fit: cover;">
                                        <div class="carousel-homepage carousel-item active">
                                            <img src="<?php echo e(asset('images/carousel1.jpg')); ?>" class="d-block w-100" alt="Carousel image">
                                        </div>
                                        <div class="carousel-homepage carousel-item">
                                            <img src="<?php echo e(asset('images/carousel2.jpg')); ?>" class="d-block w-100" alt="Carousel image">
                                        </div>
                                        <div class="carousel-homepage carousel-item">
                                            <img src="<?php echo e(asset('images/carousel3.jpg')); ?>" class="d-block w-100" alt="Carousel image">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo e(route('searchProduk')); ?>" method="GET" class="">
                            <?php echo csrf_field(); ?>
                            <div class="searchbar my-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control form-search custom-search-bar" placeholder="Mau cosplay apa hari ini?"
                                        aria-label="Search" />
                                    <button class="btn py-2 custom-search-button" type="submit" id="search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row" style="margin-left: -24px; margin-top: -10px;">
                                    <div class="col">
                                        <div class="form-filter">
                                            <select class="form-select select2" name="gender" id="selectGender" aria-label="Default select example">
                                                <option></option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                                <option value="Semua Gender">Semua</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-filter">
                                            <select class="form-select select2" name="size" id="selectSize" aria-label="Default select example">
                                                <option></option>
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                                <option value="All_Size">All Size</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-filter">
                                            <select class="form-select select2" name="series" id="selectSeries" aria-label="Default select example">
                                                <option></option>
                                                <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($seri->id); ?>"><?php echo e($seri->series); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-filter">
                                            <select class="form-select select2" name="brand" id="selectBrand" aria-label="Default select example">
                                                <option></option>
                                                <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($brandItem); ?>"><?php echo e($brandItem); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-filter">
                                            <select class="form-select select2" name="grade" id="selectGrade" aria-label="Default select example">
                                                <option></option>
                                                <option value="Grade 1">Grade 1</option>
                                                <option value="Grade 2">Grade 2</option>
                                                <option value="Grade 3">Grade 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-6">
                        <h2><strong>KOSTUM TERBARU</strong></h2>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?php echo e(route('viewPencarian')); ?>" class="no-underline">
                            <button class="btn btn-outline-danger mb-2">Lihat Semua</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <div class="row-kartu d-flex mb-3">
                    <?php $__currentLoopData = $produk->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-2" style="margin-right: 43px;">
                            <a href="<?php echo e(route('viewDetail', ['id' => $prod->id])); ?>" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                                    <?php $__currentLoopData = $fotoproduk->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk" style="object-fit: cover;">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar avatar-card me-2">
                                                <?php $__currentLoopData = $toko->where('id', $prod->id_toko); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $user->where('id', $tk->id_user); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <img class="avatar-img" src="<?php echo e(asset($usr->foto_profil)); ?>" alt="User" style="border-radius: 30px;" />
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                            <?php echo e($prod->ukuran_produk); ?>

                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                            <?php echo e($prod->grade); ?>

                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                            <?php echo e($prod->gender); ?>

                                        </button>
                                        <?php if($prod->additional): ?>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
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

        <?php if($topSeries && $topProduk->isNotEmpty()): ?>
            <div class="container-fluid mt-5">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-6">
                            <h2><strong>Top Series di Kalasewa</strong></h2>
                        </div>
                        <div class="col-6 text-end">
                            <a href="<?php echo e(route('viewPencarian', ['id_series' => $topSeries->id_series])); ?>" class="no-underline">
                                <button class="btn btn-outline-danger mb-2">Lihat Semua</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="container">
                    <div class="row-kartu d-flex mb-3">
                        <?php $__currentLoopData = $topProduk->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-2" style="margin-right: 43px;">
                                <a href="<?php echo e(route('viewDetail', ['id' => $prod->id])); ?>" class="card-link">
                                    <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                                        <?php $__currentLoopData = $fotoproduk->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk" style="object-fit: cover;">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="avatar avatar-card me-2">
                                                    <?php $__currentLoopData = $toko->where('id', $prod->id_toko); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $user->where('id', $tk->id_user); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img class="avatar-img" src="<?php echo e(asset($usr->foto_profil)); ?>" alt="User" style="border-radius: 30px;" />
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->ukuran_produk); ?>

                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->grade); ?>

                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->gender); ?>

                                            </button>
                                            <?php if($prod->additional): ?>
                                                <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
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
        <?php endif; ?>


        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-6">
                        <h2><strong>DAFTAR TOKO</strong></h2>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?php echo e(route('viewListToko')); ?>" class="no-underline">
                            <button class="btn btn-outline-danger mb-2">Lihat Semua</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <div class="row-kartu d-flex mb-3">
                    <?php $__currentLoopData = $toko; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-2" style="margin-right: 43px;">
                            <a href="<?php echo e(route('viewToko', ['id' => $tk->id])); ?>" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                                    <img src="<?php echo e(asset($tk->user->foto_profil)); ?>" class="card-img-top img-fluid h-100" alt="fotoproduk" style="object-fit: cover;">
                                    <div class="card-body">
                                        <h5><strong><?php echo e($tk->nama_toko); ?></strong></h5>
                                        <p style="margin-bottom: 5px;">Rating Toko:
                                            <?php if(isset($averageRatings[$tk->id])): ?>
                                                <?php echo e(number_format($averageRatings[$tk->id], 1)); ?>

                                            <?php else: ?>
                                                0
                                            <?php endif; ?>
                                            <i class="ri-star-line"></i>
                                        </p>
                                        <?php if(isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] >= 4): ?>
                                            <span class="badge text-white" style="background: linear-gradient(to right, #EAD946, #D99C00);">Terpercaya</span>
                                        <?php elseif(isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] > 0 && $averageRatings[$tk->id] < 2.5): ?>
                                            <span class="badge text-bg-danger">Bermasalah</span>
                                        <?php elseif(isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] >= 2.5 && $averageRatings[$tk->id] < 4): ?>
                                            <span class="badge text-white" style="background-color: #EB7F01;">Standar</span>
                                        <?php else: ?>
                                            <span class="badge text-white" style="background-color: 6DC0D0;">Pendatang
                                                Baru</span>
                                        <?php endif; ?>
                                        <p class="card-text" style="color: orange;">
                                            <i class="ri-t-shirt-line"></i>
                                            <?php echo e($tk->produks_count); ?> Kostum
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa v2\resources\views/homepage.blade.php ENDPATH**/ ?>