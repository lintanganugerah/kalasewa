<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/searchbar.css')); ?>" />

    <section>
        <div class="header-text">
            <div class="container-fluid my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1><strong>WISHLIST</strong></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert-container">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
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
                    </div>
                </div>
            </div>
        </div>

        <div class="wishlist-card-container">
            <div class="container-fluid">
                <div class="container">
                    <hr>
                    <?php $__currentLoopData = $wishlist->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row-kartu d-flex">
                            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('viewDetail', ['id' => $prod->produk->id])); ?>" class="card-link">
                                    <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%; margin-right: 5px; margin-bottom: 5px;">
                                        <?php $__currentLoopData = $fotoproduk->where('id_produk', $prod->produk->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk" style="object-fit: cover;">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class=" card-body">
                                            <div class="d-flex mb-1">
                                                <div class="avatar avatar-card me-2">
                                                    <?php $__currentLoopData = $toko->where('id', $prod->produk->id_toko); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $user->where('id', $tk->id_user); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img class="avatar-img" src="<?php echo e(asset($usr->foto_profil)); ?>" style="border-radius: 30px;" alt="User" />
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="fs-08-rem user-card">
                                                    <?php $__currentLoopData = $toko->where('id', $prod->produk->id_toko)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="fw-bold text-truncate">
                                                            <?php echo e($tk->nama_toko); ?>

                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <h5 class="card-title"><?php echo e($prod->produk->nama_produk); ?></h5>
                                            <p class="card-text">Rp<?php echo e(number_format($prod->produk->harga)); ?> / 3 Hari</p>
                                            <p class="card-text">
                                                <img src="<?php echo e(asset('storage/icon/box-seam.png')); ?>" alt="box-seam"
                                                    style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                                <?php echo e($prod->produk->brand); ?>

                                            </p>
                                            <p class="card-text">
                                                <img src="<?php echo e(asset('storage/icon/tv.png')); ?>" alt="tv" style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                                <?php echo e($prod->produk->seriesDetail->series); ?>

                                            </p>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->produk->ukuran_produk); ?>

                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->produk->grade); ?>

                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                <?php echo e($prod->produk->gender); ?>

                                            </button>
                                            <?php if($prod->produk->additional): ?>
                                                <button type="button" class="btn btn-sm btn-outline-light mb-2" disabled>
                                                    +Additional
                                                </button>
                                            <?php endif; ?>
                                            <form action="<?php echo e(route('wishlist.remove', ['id' => $prod->produk->id])); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus dari
                                                    Wishlist</button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/wishlist.blade.php ENDPATH**/ ?>