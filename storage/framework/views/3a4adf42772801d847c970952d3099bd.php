<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Daftar Bank</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Daftar Bank</li>
    </ol>
</div>
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

<div class="row">
    <div class="col-md-6 mb-3">
        <a href="<?php echo e(route('admin.banks.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Bank
        </a>
    </div>
    <div class="col-md-6 mb-3 d-flex justify-content-end">
        <form action="<?php echo e(route('admin.banks.index')); ?>" class="form-inline" method="GET">
            <input type="search" name="search" class="form-control mr-2" placeholder="Search"
                value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <?php if($banks->isEmpty()): ?>
        <div class="text-center mt-5">
            <p class="text-muted">Nama Bank tidak ditemukan.</p>
        </div>
    <?php else: ?>
        <table class="table table-data" id="banks-table">
            <thead>
                <tr>
                    <th>Nama Bank</th>
                    <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banksItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($banksItem->nama); ?></td>
                        <td width="8%">
                            <a href="<?php echo e(route('admin.banks.edit', $banksItem->id)); ?>" class="btn btn-warning btn-block">Edit</a>
                        </td>
                        <td width="8%">
                            <button class="btn btn-danger btn-block" data-toggle="modal"
                                data-target="#confirmDeleteModal<?php echo e($banksItem->id); ?>">Hapus</button>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi Delete -->
                    <div class="modal fade" id="confirmDeleteModal<?php echo e($banksItem->id); ?>" tabindex="-1" role="dialog"
                        aria-labelledby="confirmDeleteModalLabel<?php echo e($banksItem->id); ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel<?php echo e($banksItem->id); ?>">Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus nama bank ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="<?php echo e(route('admin.banks.destroy', $banksItem->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div style="display: flex; justify-content: center; margin: 20px 0;">
        <?php echo e($banks->appends(request()->query())->links()); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/banks/index.blade.php ENDPATH**/ ?>