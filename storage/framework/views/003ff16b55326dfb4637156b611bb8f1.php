<!-- resources/views/admin/category_edit.blade.php -->



<?php $__env->startSection('title', 'Edit Kategori Tiket'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kategori Tiket</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.ticket.category')); ?>">Kategori Tiket</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kategori Tiket</li>
    </ol>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php if($errors->has('nama')): ?>
    <div class="alert alert-danger mt-2">
        <?php echo e($errors->first('nama')); ?>

    </div>
<?php endif; ?>

<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">Edit Kategori Tiket</h5>
        <form action="<?php echo e(route('admin.ticket.category.update', $category->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($category->nama); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo e(route('admin.ticket.category')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/ticket/editCategory.blade.php ENDPATH**/ ?>