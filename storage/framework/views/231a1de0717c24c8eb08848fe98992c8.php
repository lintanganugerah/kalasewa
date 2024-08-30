<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Nama Bank</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.banks.index')); ?>">Kelola Daftar Bank</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Nama Bank</li>
    </ol>
</div>

<?php if($errors->has('nama')): ?>
    <div class="alert alert-danger mt-2">
        <?php echo e($errors->first('nama')); ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('admin.banks.update', $banks->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="nama">Nama Bank</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e(old('nama', $banks->nama)); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('admin.banks.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/banks/edit.blade.php ENDPATH**/ ?>