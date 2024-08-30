<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Series</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.series.index')); ?>">Manajemen Series</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Series</li>
    </ol>
</div>

<?php if($errors->has('series')): ?>
    <div class="alert alert-danger mt-2">
        <?php echo e($errors->first('series')); ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('admin.series.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="series">Nama Series</label>
                <input type="text" class="form-control" id="series" name="series" required value="<?php echo e(old('series')); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="<?php echo e(route('admin.series.index')); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/series/create.blade.php ENDPATH**/ ?>