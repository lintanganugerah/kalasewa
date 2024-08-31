<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3 ml-4">
                <!-- Tombol Back -->
                <div class="text-left mt-3 mb-4">
                    <a href="<?php echo e(route('seller.statuspenyewaan.telahkembali')); ?>" class="btn btn-outline kalasewa-color"><i
                            class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
                </div>
                <h1 class="fw-bold text-secondary">Tambah Review Penyewa</h1>
                <h4 class="fw-semibold text-secondary">Anda wajib mengisi review penyewa! Setelah itu penyewaan selesai, dan
                    penghasilan dilepas ke akun anda</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
                                <h4 class="mb-3">Review Anda</h4>
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
                                <div class="row my-3">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="product-image-container me-3">
                                                <img src="<?php echo e(asset($penyewa->foto_profil)); ?>" alt="Produk"
                                                    class="product-image">
                                            </div>
                                            <div>
                                                <h5 class="fw-bold"><?php echo e($penyewa->nama); ?>

                                                </h5>
                                                <small class="fw-light text-secondary">Bergabung Pada
                                                    <?php echo e($penyewa->created_at); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form
                                    action="<?php echo e(route('seller.view.penilaian.tambahReviewPenyewaAction', ['id' => $order->id_penyewa, 'nomor_order' => $order->nomor_order])); ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="komentar" class="form-label">Rating<span
                                                class="text-danger">*</span></label>
                                        <div class="rating">
                                            <input type="radio" name="rating" id="5" value="5"><label
                                                for="5">★</label>
                                            <input type="radio" name="rating" id="4" value="4"><label
                                                for="4">★</label>
                                            <input type="radio" name="rating" id="3" value="3"><label
                                                for="3">★</label>
                                            <input type="radio" name="rating" id="2" value="2"><label
                                                for="2">★</label>
                                            <input type="radio" name="rating" id="1" value="1"
                                                required><label for="1">★</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="komentar" class="form-label">Komentar<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="komentar" rows="10" name="komentar" required></textarea>
                                    </div>

                                    <div id="photoInputs">
                                    </div>
                                    <button type="button" id="addPhotoBtn" class="btn text-white"
                                        style="background-color: #D44E4E">Tambah Foto Review</button>

                                    <div class="d-grid mb-5 mt-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Save
                                            Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link type="text/css" href="<?php echo e(asset('seller/review.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
    <script>
        document.getElementById('ratingForm').addEventListener('submit', function(event) {
            var ratingInputs = document.getElementsByName('rating');
            var ratingChecked = false;

            for (var i = 0; i < ratingInputs.length; i++) {
                if (ratingInputs[i].checked) {
                    ratingChecked = true;
                    break;
                }
            }

            if (!ratingChecked) {
                event.preventDefault(); // Prevent form submission
                alert(
                    'Please select a rating.'
                ); // You can customize the message or use another method to inform the user
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi2/penilaian/tambahReviewPenyewa.blade.php ENDPATH**/ ?>