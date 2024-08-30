<?php $__env->startSection('title', 'Ubah Peraturan'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Peraturan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Peraturan</li>
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

<form action="<?php echo e(route('admin.regulations.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($peraturan->Judul); ?></h5>
            <div class="form-group">
                <textarea class="form-control" name="Peraturan[<?php echo e($peraturan->id); ?>]" rows="10"
                    id="editor"><?php echo e(old('Peraturan.' . $peraturan->id, $peraturan->Peraturan)); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/regulations/edit.blade.php ENDPATH**/ ?>