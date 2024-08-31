<?php $__env->startSection('content'); ?>

<section>

    <div class="container-fluid mt-5">
        <div class="container">

            <div class="text-center">
                <h1><strong>Ticketing Kalasewa</strong></h1>
            </div>

            <?php echo csrf_field(); ?>
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <div class="card mt-5">
                <div class="card-body">

                    <div class="create-button">
                        <div class="col-2">
                            <a href="<?php echo e(route('viewNewTicketing')); ?>" class="btn btn-danger w-100">Ajukan Tiket Baru</a>
                        </div>
                    </div>

                    <div class="table-ticketing mt-3">
                        <table class="table w-100" id="table-ticketing">
                            <?php if($ticketing): ?>
                                <thead>
                                    <tr>
                                        <td class="text-center fw-bold">Nomor Tiket</td>
                                        <td class="text-center fw-bold">Dibuat Tanggal</td>
                                        <td class="text-center fw-bold">Permasalahan</td>
                                        <td class="text-center fw-bold">Deskripsi</td>
                                        <td class="text-center fw-bold">Alasan Penolakan</td>
                                        <td class="text-center fw-bold">Gambar</td>
                                        <td class="text-center fw-bold">Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $ticketing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($ticket->id); ?></td>
                                            <td class="text-center"><?php echo e($ticket->created_at); ?></td>
                                            <td class="text-center"><?php echo e($ticket->kategori->nama); ?></td>
                                            <td class="text-center"><?php echo e($ticket->deskripsi); ?></td>
                                            <td class="text-center">
                                                <?php echo e($ticket->alasan_penolakan ? $ticket->alasan_penolakan : '-'); ?>

                                            </td>
                                            <td>
                                                <a class="btn btn-danger w-100" href="#" role="button" data-bs-toggle="modal"
                                                    data-bs-target="#buktiModal-<?php echo e($loop->iteration); ?>">Lihat Bukti</a>
                                            </td>
                                            <td class="text-center"><?php echo e($ticket->status); ?></td>
                                        </tr>

                                        <!-- MODAL FOTO BUKTI -->
                                        <div class="modal fade" id="buktiModal-<?php echo e($loop->iteration); ?>" tabindex="-1"
                                            aria-labelledby="examplebuktiModal-<?php echo e($loop->iteration); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Foto</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php if($ticket->bukti_tiket): ?>
                                                            <?php $__currentLoopData = $ticket->bukti_tiket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img class="rounded img-fluid mb-3" src="<?php echo e(asset($foto)); ?>"
                                                                    alt="Bukti Foto Tiket">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <p> Tidak ada Foto Bukti </p>
                                                        <?php endif; ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php else: ?>
                                Kamu belum ada mengajukan ticketing!
                            <?php endif; ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/penyewa/ticketing/ticketing.blade.php ENDPATH**/ ?>