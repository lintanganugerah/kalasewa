<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <!-- Tombol Back -->
                <div class="text-left mt-3 mb-3">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline kalasewa-color"><i
                            class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
                </div>
                <h1 class="fw-bold text-secondary">Review Penyewa</h1>
                <h4 class="fw-semibold text-secondary">Lihat komentar dan rating milik penyewa</h4>
            </div>
            <hr class="bg-dark border-2 border-top border-dark" />
            <div class="row my-4 mx-4">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="product-image-container me-3">
                            <img src="<?php echo e(asset($penyewa->foto_profil)); ?>" alt="Produk"
                                class="product-image">
                        </div>
                        <div>
                            <h5 class="fw-bold"><?php echo e($penyewa->nama); ?>

                            <?php if($penyewa->badge != 'Banned'): ?>
                                <?php if($penyewa->cek_nilai($penyewa->id)): ?>
                                    <?php if(number_format($penyewa->avg_nilai_penyewa($penyewa->id), 1) > 2.5 &&
                                            number_format($penyewa->avg_nilai_penyewa($penyewa->id), 1) < 4): ?>
                                        <span class="badge text-white ms-3" style="background-color: EB7F01;">
                                            Standart</span>
                                    <?php elseif(number_format($penyewa->avg_nilai_penyewa($penyewa->id), 1) < 2.5): ?>
                                        <span class="badge badge-danger text-white ms-3">
                                            Bermasalah</span>
                                    <?php elseif(number_format($penyewa->avg_nilai_penyewa($penyewa->id), 1) >= 4): ?>
                                        <span class="badge text-white ms-3"
                                            style="background: linear-gradient(to right, #EAD946, #D99C00);">
                                            Terpercaya</span>
                                    <?php else: ?>
                                        <span class="badge text-white ms-3" style="background-color: 6DC0D0;">
                                            Pendatang Baru</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge text-white ms-3" style="background-color: 6DC0D0;">
                                        Pendatang Baru</span>
                                <?php endif; ?>
                            
                        <?php else: ?>
                         <span class="badge text-white ms-3 text-bg-dark">
                                    Banned</span>
                        <?php endif; ?>
                        </h5>
                        <small class="fw-light text-secondary">Bergabung Pada
                                <?php echo e($penyewa->created_at->toDateString()); ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-respon">
                    <h1 class="fw-bold" style="color:#CE2525">Total Rating</h1>
                    <h2 class="fw-semibold">
                        <?php if($penyewa->cek_nilai($penyewa->id)): ?>
                            <?php echo e(number_format($penyewa->avg_nilai_penyewa($penyewa->id), 1)); ?>/5
                            <small>
                                (<?php echo e($penyewa->total_review_penyewa($penyewa->id)); ?> review)
                            </small>
                        <?php else: ?>
                            --/5
                        <?php endif; ?>
                    </h2>
                </div>
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
                                            <?php if($penilaianPenyewa): ?>
                                                <thead>
                                                    <tr>
                                                        <th>Pemilik Sewa</th>
                                                        <th class="col-7">Komentar</th>
                                                        <th>Nilai</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $penilaianPenyewa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td data-title="Pemilik Sewa" class="align-middle">
                                                                <div class="d-flex align-items-center">
                                                                    <!-- Foto profil toko -->
                                                                    <div class="image-tabel">
                                                                        <div
                                                                            class="product-image-container product-image-container-tabel">
                                                                            <img src="<?php echo e(asset($review->getFotoProfilToko($review->id_toko)->foto_profil)); ?>"
                                                                                alt="Produk" class="product-image">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Nama Toko -->
                                                                    <div class="margin-start">
                                                                        <h5><?php echo e($review->id_review_toko->nama_toko); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td data-title="Komentar" class="align-middle">
                                                                <?php echo e($review->komentar); ?>

                                                            </td>
                                                            <td data-title="Penilaian" class="align-middle">
                                                                <?php echo e($review->nilai); ?>/5</td>
                                                            <td data-title="Aksi" class="align-middle">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#modal-foto-<?php echo e($review->id); ?>"
                                                                    class="btn btn-outline" id="proses"
                                                                    style="color:#CE2525">Lihat
                                                                    Foto Review</button>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal-foto-<?php echo e($review->id); ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="modal-foto-<?php echo e($review->id); ?>Label"
                                                            aria-hidden="true">
                                                            <div
                                                                class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="modal-foto-<?php echo e($review->id); ?>Label">
                                                                            Foto Review</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div
                                                                            class="d-flex justify-content-start align-items-center">
                                                                            <div class="row">
                                                                                <?php if($review->foto): ?>
                                                                                    <?php $__currentLoopData = json_decode($review->foto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col my-2">
                                                                                            <div
                                                                                                class="product-image-container-review">
                                                                                                <img src="<?php echo e(asset($f)); ?>"
                                                                                                    alt="Produk"
                                                                                                    class="product-image-review">
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php else: ?>
                                                                                    <p> Tidak ada Foto Review </p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="" class="img-fluid" id="enlargedImg" alt="Enlarged Image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeImageModalBtn">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.tabel-data').DataTable({
                lengthMenu: [
                    [5, 15, 30, -1],
                    [5, 15, 30, 'All']
                ],
            });
        </script>
        <script src="<?php echo e(asset('seller/modal_auto_muncul.js')); ?>"></script>
        <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
        <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
    </div>
<?php $__env->stopSection(); ?>

<link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa\resources\views/pemilikSewa/iterasi2/penilaian/reviewPenyewa.blade.php ENDPATH**/ ?>