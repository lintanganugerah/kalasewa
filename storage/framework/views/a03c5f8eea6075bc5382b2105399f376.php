<?php $__env->startSection('title', 'Manajemen User'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
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

<!-- Tabel User Penyewa dan Pemilik Sewa -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="card-title">User</h5>
    </div>

    <div class="card-body">
        <!-- Kolom Pencarian -->
        <div class="mb-4">
            <form action="<?php echo e(route('admin.users.search')); ?>" method="GET" class="w-100">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered" id="users-table">
                <thead class="text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Reputasi</th>
                        <th>Verifikasi</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->role !== 'admin' && $user->role !== 'super_admin'): ?>
                                            <tr>
                                                <td><?php echo e($user->nama); ?></td>
                                                <td class="text-center align-middle"><?php echo e($user->email); ?></td>
                                                <td class="text-center align-middle">
                                                    <?php if($user->role === 'penyewa'): ?>
                                                        Penyewa
                                                    <?php elseif($user->role === 'pemilik_sewa'): ?>
                                                        Pemilik Sewa
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php echo e($user->badge); ?></td>
                                                <td class="text-center align-middle">
                                                    <?php if($user->role === 'penyewa'): ?>
                                                                        <?php
                                                                            $avg_nilai_penyewa = round($user->avg_nilai_penyewa($user->id), 1);
                                                                        ?>
                                                                        <?php if($avg_nilai_penyewa > 4): ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_penyewa); ?>"
                                                                                style="background: linear-gradient(to right, #EAD946, #D99C00);">
                                                                                Terpercaya
                                                                            </span>
                                                                        <?php elseif($avg_nilai_penyewa >= 2.5 && $avg_nilai_penyewa <= 4): ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_penyewa); ?>"
                                                                                style="background-color: #EB7F01;">
                                                                                Standart
                                                                            </span>
                                                                        <?php elseif($avg_nilai_penyewa >= 0.1 && $avg_nilai_penyewa <= 2.5): ?>
                                                                            <span class="badge badge-danger" title="<?php echo e($avg_nilai_penyewa); ?>">
                                                                                Bermasalah
                                                                            </span>
                                                                        <?php else: ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_penyewa); ?>"
                                                                                style="background-color: #6DC0D0;">
                                                                                Pendatang Baru
                                                                            </span>
                                                                        <?php endif; ?>
                                                    <?php elseif($user->role === 'pemilik_sewa'): ?>
                                                                        <?php
                                                                            $avg_nilai_toko = round($user->avg_nilai_toko($user->id), 1);
                                                                        ?>
                                                                        <?php if($avg_nilai_toko > 4): ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_toko); ?>"
                                                                                style="background: linear-gradient(to right, #EAD946, #D99C00);">
                                                                                Terpercaya
                                                                            </span>
                                                                        <?php elseif($avg_nilai_toko >= 2.5 && $avg_nilai_toko <= 4): ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_toko); ?>"
                                                                                style="background-color: #EB7F01;">
                                                                                Standart
                                                                            </span>
                                                                        <?php elseif($avg_nilai_toko >= 0.1 && $avg_nilai_toko <= 2.5): ?>
                                                                            <span class="badge badge-danger" title="<?php echo e($avg_nilai_toko); ?>">
                                                                                Bermasalah
                                                                            </span>
                                                                        <?php else: ?>
                                                                            <span class="badge text-white ms-3" title="<?php echo e($avg_nilai_toko); ?>"
                                                                                style="background-color: #6DC0D0;">
                                                                                Pendatang Baru
                                                                            </span>
                                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="badge text-white ms-3" style="background-color: 6DC0D0;">
                                                            Pendatang Baru
                                                        </span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center align-middle">
                                                    <?php if($user->verifyIdentitas === 'Sudah'): ?>
                                                        <span class="badge badge-success badge-pill px-3 py-2">Verified</span>
                                                    <?php elseif($user->verifyIdentitas === 'Tidak'): ?>
                                                        <span class="badge badge-warning badge-pill px-3 py-2">Unverified</span>
                                                    <?php elseif($user->verifyIdentitas === 'Ditolak'): ?>
                                                        <span class="badge badge-danger badge-pill px-3 py-2">Rejected</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary badge-pill px-3 py-2">Unknown</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle" style="width: 10%;">
                                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                                        class="btn btn-primary btn-block">Lihat</a>
                                                </td>
                                                <td class="text-center align-middle" style="width: 10%;">
                                                    <?php if($user->badge === 'Banned'): ?>
                                                        <!-- Tombol Aktifkan -->
                                                        <button type="button" class="btn btn-success btn-block"
                                                            onclick="confirmAction(<?php echo e($user->id); ?>, 'Aktifkan')">
                                                            Aktifkan
                                                        </button>
                                                    <?php else: ?>
                                                        <!-- Tombol Nonaktifkan -->
                                                        <button type="button" class="btn btn-danger btn-block"
                                                            onclick="confirmAction(<?php echo e($user->id); ?>, 'Nonaktifkan')">
                                                            Nonaktifkan
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div style="display: flex; justify-content: center; margin: 20px 0;">
                <?php echo e($users->appends(['admin_page' => $adminUsers->currentPage()])->links()); ?>

            </div>
        </div>
    </div>
</div>


<!-- Tabel Admin -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="card-title">Admin</h5>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Admin</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="admin-users-table">
                <thead style="text-align: center;">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width:10%">Role</th>
                        <th colspan="2" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $adminUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->role == 'admin' || $user->role == 'super_admin'): ?>
                            <tr>
                                <td><?php echo e($user->nama); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td class="text-center">
                                    <?php if($user->role === 'super_admin'): ?>
                                        <span class="badge badge-success badge-pill px-3 py-2">Super Admin</span>
                                    <?php elseif($user->role === 'admin'): ?>
                                        <span class="badge badge-warning badge-pill px-3 py-2">Admin</span>
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <?php if(Auth::check() && (Auth::user()->role === 'super_admin' || Auth::user()->id === $user->id)): ?>
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                            class="btn btn-warning btn-block">Edit</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                            class="btn btn-primary btn-block">Lihat</a>
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <?php if(Auth::check()): ?>
                                        <?php if(Auth::user()->role === 'super_admin'): ?>
                                            <?php if(Auth::user()->id === $user->id): ?>
                                                <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                                    disabled>Delete</button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                                    onclick="confirmDelete('<?php echo e($user->id); ?>')" data-toggle="modal"
                                                    data-target="#confirmDeleteModal">Delete</button>
                                            <?php endif; ?>
                                        <?php elseif(Auth::user()->role === 'admin'): ?>
                                            <?php if(Auth::user()->id === $user->id): ?>
                                                <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                                    onclick="confirmDelete('<?php echo e($user->id); ?>')" data-toggle="modal"
                                                    data-target="#confirmDeleteModal">Delete</button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                                    disabled>Delete</button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                                disabled>Delete</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                                            disabled>Delete</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div style="display: flex; justify-content: center; margin: 20px 0;">
                <?php echo e($adminUsers->appends(['users_page' => $users->currentPage()])->links()); ?>

            </div>
        </div>
    </div>
</div>

<!-- Modal Nonaktifkan -->
<div class="modal fade" id="nonaktifkanModal" tabindex="-1" role="dialog" aria-labelledby="nonaktifkanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nonaktifkanModalLabel">Konfirmasi Nonaktifkan Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nonaktifkanForm" action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <div class="form-group">
                        <label for="reason">Alasan Nonaktifkan:</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Aktifkan -->
<div class="modal fade" id="aktifkanModal" tabindex="-1" role="dialog" aria-labelledby="aktifkanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aktifkanModalLabel">Konfirmasi Aktivasi Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengaktifkan kembali akun ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="aktifkanForm" action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-success">Aktifkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus user ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" action="" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmAction(userId, action) {
        if (action === 'Nonaktifkan') {
            var nonaktifkanForm = document.getElementById('nonaktifkanForm');
            nonaktifkanForm.action = '/admin/users/' + userId + '/nonaktifkan';
            $('#nonaktifkanModal').modal('show');
        }

        else if (action === 'Aktifkan') {
            var aktifkanForm = document.getElementById('aktifkanForm');
            aktifkanForm.action = '/admin/users/' + userId + '/nonaktifkan';
            $('#aktifkanModal').modal('show');
        }

        else {
            var url = '/admin/users/' + userId + '/nonaktifkan';
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            var token = document.createElement('input');
            token.name = '_token';
            token.value = '<?php echo e(csrf_token()); ?>';
            form.appendChild(token);
            var method = document.createElement('input');
            method.name = '_method';
            method.value = 'POST';
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function confirmDelete(userId) {
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = "<?php echo e(route('admin.users.destroy', '')); ?>/" + userId;
    }

    function confirmNonaktifkan() {
        return confirm('Apakah Anda yakin ingin menonaktifkan user ini?');
    }

    function confirmAktifkan() {
        return confirm('Apakah Anda yakin ingin Aktifkan user ini?');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/users/index.blade.php ENDPATH**/ ?>