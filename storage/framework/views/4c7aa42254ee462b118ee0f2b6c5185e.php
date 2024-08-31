<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Penilaian</h1>
                <h4 class="fw-semibold text-secondary">Lihat penilaian setiap produk anda disini</h4>
            </div>

            <div class="row gx-5">
                <div class="card">
                    <div class="tab-content">
                        <div class="card-body">
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
                                        <table id="tabel"
                                            class="no-more-tables table table-sm table-light w-100 tabel-data align-items-center"
                                            style="word-wrap: break-word;" cellspacing="0">
                                            <?php if($produk): ?>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Produk</th>
                                                        <th>Avg Nilai</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prdk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td data-title="#" class="align-middle"><?php echo e($loop->iteration); ?>

                                                            </td>
                                                            <td data-title="Produk" class="align-middle">
                                                                <div class="d-flex align-items-center">
                                                                    <div
                                                                        class="product-image-container product-image-container-tabel">
                                                                        <img src="<?php echo e(asset($prdk->getFotoProdukFirst($prdk->id)->path)); ?>"
                                                                            alt="Produk" class="product-image">
                                                                        <!-- Foto Produk yang pertama dari id_produk di tabel review -->
                                                                    </div>
                                                                    <div class="margin-start">
                                                                        <h5><?php echo e($prdk->nama_produk); ?></h5>
                                                                        <!-- Nama Produk sesuai dari id_produk di tabel review -->
                                                                        <small
                                                                            class="fw-light text-secondary"><?php echo e($prdk->brand); ?>,
                                                                            <?php echo e($prdk->gender); ?>,
                                                                            <?php echo e($prdk->series->series); ?>,
                                                                            <?php echo e($prdk->ukuran_produk); ?></small>
                                                                        <!-- Detail dari Produk yaitu brand, gender, series, ukuran -->
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td data-title="Avg Penilaian" class="align-middle">
                                                                <?php if($prdk->cek_nilai($prdk->id)): ?>
                                                                    <?php echo e(number_format($prdk->avg_nilai_produk($prdk->id), 1)); ?>/5
                                                                    <small>
                                                                        (<?php echo e($prdk->total_review_produk($prdk->id)); ?>

                                                                        review)
                                                                    </small>
                                                                <?php else: ?>
                                                                    Belum ada Penilaian
                                                                <?php endif; ?>
                                                            </td>
                                                            <!-- Penilaian dari tabel review berdasarkan produk -->
                                                            <td data-title="Aksi" class="align-middle">
                                                                <a href="<?php echo e(route('seller.view.penilaian.detailPenilaianProduk', $prdk->id)); ?>"
                                                                    class="btn btn-outline" id="proses"
                                                                    style="color:#CE2525">Lihat
                                                                    Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            <?php endif; ?>
                                        </table>
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
                    [25, -1],
                    [25, 'All']
                ],
            });
        </script>
        <script src="<?php echo e(asset('seller/modal_auto_muncul.js')); ?>"></script>
        <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
        <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
    </div>
<?php $__env->stopSection(); ?>
<link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi2/penilaian/penilaianProduk.blade.php ENDPATH**/ ?>