<?php $__env->startSection('content'); ?>
    <section>
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="col text-center">
                    <h1><strong>Checkout Pesanan Kamu!</strong></h1>
                </div>
            </div>
        </div>

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

        <div class="container-fluid mt-5">
            <div class="container">
                <div class="card">
                    <div class="card-body w-100">
                        <?php if($checkout->isNotEmpty()): ?>
                            <?php $__currentLoopData = $checkout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo e(asset($item->produk->fotoProduk->path)); ?>" alt="Catalog"
                                            class="img-thumbnail">
                                    </div>
                                    <div class="col-8">
                                        <h3><strong><?php echo e($item->produk->nama_produk); ?></strong></h3>
                                        <p>Size : <?php echo e($item->ukuran); ?></p>
                                        <p>Additional:
                                            <?php if(!empty($item->additional)): ?>
                                                <?php $__currentLoopData = $item->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($additionalItem['nama']); ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </p>
                                        <p>Status: <span class="text-danger"><?php echo e($item->status); ?></span></p>
                                        <p class="text-danger fw-bold">MOHON SEGERA LAKUKAN PEMBAYARAN DIBAWAH 10 MENIT!
                                        </p>
                                    </div>
                                    <div class="col-2 row text-end align-self-end">
                                        <h2><strong>Rp<?php echo e(number_format($item->grand_total, 0, '', '.')); ?></strong></h2>
                                        
                                        <button id="pay-button-<?php echo e($item->snapToken); ?>"
                                            class="btn btn-danger">Checkout</button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p class="text-center">Kamu sedang tidak ada proses checkout!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if($checkout->isNotEmpty()): ?>
        <?php $__currentLoopData = $checkout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
            <script type="text/javascript">
                document.getElementById('pay-button-<?php echo e($item->snapToken); ?>').onclick = function() {
                    $.ajax({
                        url: '<?php echo e(route('getTransaction')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            transactionId: '<?php echo e($item->snapToken); ?>',
                            nomor_order: '<?php echo e($item->nomor_order); ?>',
                        },
                        success: function(response) {
                            if (response.success) {
                                snap.pay('<?php echo e($item->snapToken); ?>', {
                                    onSuccess: function(result) {
                                        $.ajax({
                                            url: '<?php echo e(route('updateCheckout')); ?>',
                                            type: 'POST',
                                            data: {
                                                _token: '<?php echo e(csrf_token()); ?>',
                                                nomor_order: '<?php echo e($item->nomor_order); ?>'
                                            },
                                            success: function(response) {
                                                if (response.success) {
                                                    window.location.href = response
                                                        .redirect_url;
                                                } else {
                                                    alert(
                                                        'Pembayaran berhasil, tetapi gagal memperbarui status pesanan.'
                                                    );
                                                }
                                            },
                                            error: function() {
                                                alert(
                                                    'Pembayaran berhasil, tetapi terjadi kesalahan saat memperbarui status pesanan.'
                                                );
                                            }
                                        });
                                    },
                                    onPending: function(result) {
                                        /* You may add your own js ;here, this is just example */
                                        document.getElementById('result-json').innerHTML += JSON
                                            .stringify(result, null, 2);
                                    },
                                    onError: function(result) {
                                        alert("error:" + result.status_code + result.error_messages);
                                        /* You may add your own js here, this is just example */
                                        document.getElementById('result-json').innerHTML += JSON
                                            .stringify(result, null, 2);
                                    }
                                });
                            } else {
                                if (response.message == 'expired') {
                                    alert(
                                        'Pembayaran Expired ! Mohon Order Kembali'
                                    );
                                    window.location.href = response
                                        .redirect_url;
                                } else if (response.message == 'success') {
                                    window.location.href = response
                                        .redirect_url;
                                } else {
                                    alert('error lain');
                                }
                            }
                        },
                        error: function() {
                            console.log(response);
                            alert(
                                'Terjadi Kesahalah. Mohon Refresh halaman anda'
                            );
                        }
                    });
                };
            </script>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/pemesanan/checkout.blade.php ENDPATH**/ ?>