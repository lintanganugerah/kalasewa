<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Peraturan Sewa</h1>
                <h4 class="fw-semibold text-secondary">Manajemen peraturan dan denda sewa toko anda</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="profil-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/profil/toko'" type="button" role="tab"
                                    aria-controls="profil" aria-selected="true">Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="profil-tab"
                                    onclick="window.location.href='/profil/toko/AlamatTambahan'" type="button"
                                    role="tab" aria-selected="false">Alamat Lainnya</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-secondary fw-bold" id="contact-tab"
                                    onclick="window.location.href='/profil/toko/peraturansewa'" type="button"
                                    role="tab" aria-controls="contact" aria-selected="false">Peraturan
                                    Sewa Toko
                                    Anda</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profil" role="tabpanel"
                                aria-labelledby="profil-tab">
                                <div class="row d-flex align-items-center">
                                    <div class="col">
                                        <h5> Peraturan dan Denda </h5>
                                        <div id="helpberat" class="mb-3" style="opacity: 75%;"> Kalasewa telah memiliki
                                            peraturan secara general <a data-bs-toggle="modal"
                                                data-bs-target="#syaratdanKetentuan" class="text-reset"
                                                style="text-decoration: underline!important;">(Klik untuk
                                                lihat)</a>, namun
                                            anda bisa memasukkan
                                            peraturan khusus toko anda disini. Peraturan yang anda tetapkan
                                            akan muncul pada detail produk sehingga mudah dilihat penyewa. </div>
                                    </div>
                                    <div class="col text-end">
                                        <!-- Button trigger modal -->
                                        <a type="button" class="btn btn-kalasewa"
                                            href="<?php echo e(route('seller.profil.viewTambahPeraturanSewa')); ?>">
                                            Tambah Peraturan
                                        </a>
                                    </div>
                                </div>
                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="text-dark rounded-3 mt-4">
                                    <table id="tabel" class="no-more-tables table w-100 tabel-data align-items-center"
                                        style="word-wrap: break-word;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="col-2">Nama Peraturan</th>
                                                <th class="col-7">Deskripsi Peraturan</th>
                                                <th>Denda</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td data-title="#" class="align-middle"><?php echo e($loop->iteration); ?>

                                                    </td>
                                                    <td data-title="Nama Peraturan" class="align-middle"><?php echo e($aturan->nama); ?>

                                                    </td>
                                                    <td data-title="Deskripsi Peraturan" class="align-middle">
                                                        <?php echo e($aturan->deskripsi); ?>

                                                    </td>
                                                    <?php if($aturan->terdapat_denda): ?>
                                                        <?php if($aturan->denda_pasti): ?>
                                                            <td data-title="Denda" class="align-middle">
                                                                Rp. <?php echo e(number_format($aturan->denda_pasti, 0, '', '.')); ?>

                                                            </td>
                                                        <?php else: ?>
                                                            <td data-title="Denda" class="align-middle">
                                                                <?php echo e($aturan->denda_kondisional); ?>

                                                            </td>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <td data-title="Denda" class="align-middle">-
                                                        </td>
                                                    <?php endif; ?>
                                                    <td data-title="Aksi" class="align-middle">
                                                        <a type="button"
                                                            href="<?php echo e(route('seller.profil.viewEditPeraturanSewa', $aturan->id)); ?>"
                                                            class="d-grid btn btn-outline-primary m-2"
                                                            id="proses">Edit</a>
                                                        <?php if($aturan->nama == 'Terlambat Mengembalikan Kostum'): ?>
                                                            <small> Maaf anda hanya bisa mengedit peraturan ini </small>
                                                        <?php else: ?>
                                                            <form
                                                                action="<?php echo e(route('seller.profil.DeletePeraturanSewaAction', $aturan->id)); ?>"
                                                                method="POST" class="d-grid m-2"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger">Hapus</button>
                                                            </form>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo e(route('seller.profil.viewTambahPeraturanSewa')); ?>"
                                        class="btn btn-primary">Lakukan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="syaratdanKetentuan" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="syaratdanKetentuanlLabel">Harap baca
                                        syarat dan Ketentuan berikut!</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="syaratKetentuan">
                                        <?php $__currentLoopData = $peraturanKalasewa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-1">
                                                        <strong><?php echo e($peraturan->Judul); ?></strong></h4>
                                                    <p class="card-text mb-0">
                                                        <?php echo $peraturan->Peraturan; ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
                    [5, 10, 25, -1],
                    [5, 10, 25, 'All']
                ],
            });
        </script>
        <script src="<?php echo e(asset('seller/inputangka.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi2/peraturanSewa/peraturanSewaToko.blade.php ENDPATH**/ ?>