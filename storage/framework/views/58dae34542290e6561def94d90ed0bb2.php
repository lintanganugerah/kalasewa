<?php if($topproduk == 'tidak ada produk'): ?>
    <p> Anda belum memiliki produk. </p>
<?php elseif($topproduk->isNotEmpty()): ?>
    <table class="table w-100 table-borderless table-responsive">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Produk</th>
                <th width="4%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $topproduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idproduk => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="align-middle">
                        <div class="product-image-container me-3">
                            <img src="<?php echo e(asset($produk->first()->id_produk_order->FotoProduk->path)); ?>" alt="Produk"
                                class="product-image">
                        </div>
                    </td>
                    <td class="align-middle">
                        <div>
                            <h5 class="cut-text"><?php echo e($produk->first()->id_produk_order->nama_produk); ?></h5>
                            <small class="fw-light text-secondary"><?php echo e($produk->first()->id_produk_order->brand); ?>,
                                <?php echo e($produk->first()->id_produk_order->gender); ?>,
                                <?php echo e($produk->first()->id_produk_order->series->series); ?>,
                                <?php echo e($produk->first()->id_produk_order->ukuran_produk); ?></small>
                        </div>
                    </td>
                    <td class="align-middle">
                        <p class="m-0 small fw-bold card-link" href="#">
                            <?php echo e($produk->count()); ?>x disewa</p>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p> Belum ada top produk</p>
<?php endif; ?>
<?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/pemilikSewa/iterasi3/topproduk_tabel.blade.php ENDPATH**/ ?>