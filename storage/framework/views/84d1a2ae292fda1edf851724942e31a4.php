<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/searchbar.css')); ?>" />
<section>

    <div class="header-title">
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><strong>Cari toko favoritmu!</strong></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-select">
        <div class="container-fluid">
            <div class="container">
                <div class="form-filter">
                    <form action="<?php echo e(route('searchToko')); ?>" method="GET" class="">
                        <?php echo csrf_field(); ?>
                        <div class="searchbar my-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-search custom-search-bar"
                                    placeholder="Toko mana yang akan dikunjungi hari ini?" aria-label="Search" />
                                <button class="btn py-2 custom-search-button" type="submit" id="search-button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <?php $__currentLoopData = $toko->chunk(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row-kartu d-flex mb-3">
                <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-2" style="margin-right: 43px;">
                    <a href="<?php echo e(route('viewToko', ['id' => $tk->id])); ?>" class="card-link">
                        <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                            <img src="<?php echo e(asset($tk->user->foto_profil)); ?>" class="card-img-top img-fluid h-100"
                                alt="fotoproduk" style="object-fit: cover;">
                            <div class="card-body">
                                <h5 style="margin-bottom: 5px;"><strong><?php echo e($tk->nama_toko); ?></strong></h5>
                                <p style="margin-bottom: 5px;">Rating Toko:
                                    <?php if(isset($averageRatings[$tk->id])): ?>
                                    <?php echo e(number_format($averageRatings[$tk->id], 1)); ?>

                                    <?php else: ?>
                                    0
                                    <?php endif; ?>
                                    <i class="ri-star-line"></i>
                                </p>
                                <?php if(isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] >= 4): ?>
                                <span class="badge text-white"
                                    style="background: linear-gradient(to right, #EAD946, #D99C00);">Terpercaya</span>
                                <?php elseif(
                                isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] > 0 &&
                                $averageRatings[$tk->id] < 2.5 ): ?> <span class="badge text-bg-danger">Bermasalah</span>
                                    <?php elseif(
                                    isset($averageRatings[$tk->id]) && $averageRatings[$tk->id] >= 2.5 &&
                                    $averageRatings[$tk->id] < 4 ): ?> <span class="badge text-white"
                                        style="background-color: #EB7F01;">Standar</span>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/listToko.blade.php ENDPATH**/ ?>