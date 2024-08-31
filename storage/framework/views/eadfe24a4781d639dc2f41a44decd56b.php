<?php $__env->startSection('title', 'Verifikasi Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Verifikasi User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Verifikasi User</li>
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

<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">Pending Request</h5>
        <div class="table-responsive">
            <?php if($users->isEmpty()): ?>
                <p>Sedang tidak ada permintaan verifikasi tertunda.</p>
            <?php else: ?>
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user->role !== 'admin' && $user->verifyIdentitas !== 'Ditolak'): ?>
                                <tr>
                                    <td><?php echo e($user->nama); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <?php if($user->role === 'penyewa'): ?>
                                            Penyewa
                                        <?php elseif($user->role === 'pemilik_sewa'): ?>
                                            Pemilik Sewa
                                        <?php endif; ?>
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="<?php echo e(route('admin.users.show', $user->id)); ?>"
                                            class="btn btn-primary btn-block">Tampilkan</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/verify/index.blade.php ENDPATH**/ ?>