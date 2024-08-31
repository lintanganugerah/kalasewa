<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/searchbar.css')); ?>" />

<style>
.select2-container .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    padding-right: 150%;
    cursor: pointer;
}
</style>

<section>

    <div class="header-title">
        <div class="container-fluid mt-3">
            <div class="container">
                <div class="row">
                    <div class="hero text-center mt-5">
                        <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="Logo Kalasewa"
                            style="width: 100px; height: 100px;">
                        <h1><strong>KALASEWA</strong></h1>
                        <h4>Mau cari kostum apa hari ini?</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-select">
        <div class="container-fluid">
            <div class="container">
                <div class="form-filter">
                    <form action="<?php echo e(route('searchProduk')); ?>" method="GET" class="">
                        <?php echo csrf_field(); ?>
                        <div class="searchbar my-3">
                            <div class="input-group">
                                <input type="text" name="search"
                                    class="form-control form-search custom-search-bar text-dark"
                                    placeholder="Mau cosplay apa hari ini?" aria-label="Search"
                                    value="<?php echo e(request()->input('search')); ?>" />
                                <button class="btn py-2 custom-search-button" type="submit" id="search-button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="margin-left: -24px; margin-top: -10px;">
                                <div class="col">
                                    <div class="form-filter">
                                        <select class="form-select select2" name="gender" id="selectGender"
                                            aria-label="Default select example">
                                            <option></option>
                                            <option value="Pria"
                                                <?php echo e(request()->input('gender') == 'Pria' ? 'selected' : ''); ?>>
                                                Pria</option>
                                            <option value="Wanita"
                                                <?php echo e(request()->input('gender') == 'Wanita' ? 'selected' : ''); ?>>Wanita
                                            </option>
                                            <option value="Semua Gender"
                                                <?php echo e(request()->input('gender') == 'Semua Gender' ? 'selected' : ''); ?>>
                                                Semua</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-filter">
                                        <select class="form-select select2" name="size" id="selectSize"
                                            aria-label="Default select example">
                                            <option></option>
                                            <option value="XS" <?php echo e(request()->input('size') == 'XS' ? 'selected' : ''); ?>>
                                                XS
                                            </option>
                                            <option value="S" <?php echo e(request()->input('size') == 'S' ? 'selected' : ''); ?>>S
                                            </option>
                                            <option value="M" <?php echo e(request()->input('size') == 'M' ? 'selected' : ''); ?>>M
                                            </option>
                                            <option value="L" <?php echo e(request()->input('size') == 'L' ? 'selected' : ''); ?>>L
                                            </option>
                                            <option value="XL" <?php echo e(request()->input('size') == 'XL' ? 'selected' : ''); ?>>
                                                XL
                                            </option>
                                            <option value="XXL"
                                                <?php echo e(request()->input('size') == 'XXL' ? 'selected' : ''); ?>>
                                                XXL
                                            </option>
                                            <option value="All_Size"
                                                <?php echo e(request()->input('size') == 'All_Size' ? 'selected' : ''); ?>>All Size
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-filter">
                                        <select class="form-select select2" name="series" id="selectSeries"
                                            aria-label="Default select example">
                                            <option></option>
                                            <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($seri->id); ?>"
                                                <?php echo e(request()->input('series') == $seri->id ? 'selected' : ''); ?>>
                                                <?php echo e($seri->series); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-filter">
                                        <select class="form-select select2" name="brand" id="selectBrand"
                                            aria-label="Default select example">
                                            <option></option>
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brandItem); ?>"
                                                <?php echo e(request()->input('brand') == $brandItem ? 'selected' : ''); ?>>
                                                <?php echo e($brandItem); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-filter">
                                        <select class="form-select select2" name="grade" id="selectGrade"
                                            aria-label="Default select example">
                                            <option></option>
                                            <option value="Grade 1"
                                                <?php echo e(request()->input('grade') == 'Grade 1' ? 'selected' : ''); ?>>Grade 1
                                            </option>
                                            <option value="Grade 2"
                                                <?php echo e(request()->input('grade') == 'Grade 2' ? 'selected' : ''); ?>>Grade 2
                                            </option>
                                            <option value="Grade 3"
                                                <?php echo e(request()->input('grade') == 'Grade 3' ? 'selected' : ''); ?>>Grade 3
                                            </option>
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

    <div class="show-produk mt-5">
        <div class="container-fluid">
            <div class="container">
                <?php $__currentLoopData = $produk->chunk(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row-kartu d-flex mb-3">
                    <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-2" style="margin-right: 43px;">
                        <a href="<?php echo e(route('viewDetail', ['id' => $prod->id])); ?>" class="card-link">
                            <div class="card custom-card text-bg-dark border-secondary"
                                style="width: 250px; height: 100%;">
                                <?php $__currentLoopData = $fotoproduk->where('id_produk', $prod->id)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset($foto->path)); ?>" class="card-img-top img-fluid h-50" alt="fotoproduk"
                                    style="object-fit: cover;">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class=" card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-card me-2">
                                            <?php $__currentLoopData = $toko->where('id', $prod->id_toko); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $user->where('id', $tk->id_user); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img class="avatar-img" src="<?php echo e(asset($usr->foto_profil)); ?>" alt="User" />
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
                                    <h5 class="card-title" style="margin-bottom: 2px;">
                                        <?php echo e($prod->nama_produk); ?></h5>
                                    <p class="card-text" style="color: orange;">
                                        <strong>Rp<?php echo e(number_format($prod->harga)); ?>

                                            /
                                            3 Hari</strong>
                                    </p>

                                    <p class="card-text">
                                        <img src="<?php echo e(asset('storage/icon/box-seam.png')); ?>" alt="box-seam"
                                            style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                        <?php echo e($prod->brand); ?>

                                    </p>

                                    <p class="card-text">
                                        <img src="<?php echo e(asset('storage/icon/tv.png')); ?>" alt="tv"
                                            style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/pencarian.blade.php ENDPATH**/ ?>