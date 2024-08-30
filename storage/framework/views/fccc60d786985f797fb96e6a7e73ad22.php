<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.users.index')); ?>">Manajemen User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <!-- Informasi User -->
                    <div class="col-md-6">
                        <h4>Informasi User</h4>
                        <!-- Common fields for all roles -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nama" name="nama"
                                value="<?php echo e($user->nama); ?>"
                                <?php if(Auth::check() && (
                                    (Auth::user()->role === 'super_admin' && $user->role === 'admin') || 
                                    Auth::user()->id === $user->id)): ?>
                                <?php else: ?>
                                    readonly
                                <?php endif; ?>>
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email"
                                value="<?php echo e($user->email); ?>"
                                <?php if(Auth::check() && (
                                    (Auth::user()->role === 'super_admin' && $user->role === 'admin') || 
                                    Auth::user()->id === $user->id)): ?>
                                <?php else: ?>
                                    readonly
                                <?php endif; ?>>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telepon</label>
                            <input type="tel" class="form-control <?php $__errorArgs = ['no_telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="no_telp" name="no_telp"
                                value="<?php echo e($user->no_telp); ?>"
                                <?php if(Auth::check() && (
                                    (Auth::user()->role === 'super_admin' && $user->role === 'admin') || 
                                    Auth::user()->id === $user->id)): ?>
                                <?php else: ?>
                                    readonly
                                <?php endif; ?>
                                pattern="[0-9]{10,}" title="Hanya boleh angka dengan minimal 10 digit">
                        </div>
                        <?php if($user->role == 'penyewa' || $user->role == 'pemilik_sewa'): ?>
                            <div class="form-group">
                                <label for="no_darurat">No. Darurat</label>
                                <input type="text" class="form-control" id="no_darurat" name="no_darurat"
                                    value="<?php echo e($user->no_darurat); ?> (<?php echo e($user->ket_no_darurat); ?>)" readonly>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="role" style="margin-right: 8px;">Role :</label>
                                <?php if($user->role == 'super_admin'): ?>
                                    <span class="badge badge-success badge-pill px-3 py-2">Super Admin</span>
                                <?php elseif($user->role == 'admin'): ?>
                                    <span class="badge badge-warning badge-pill px-3 py-2">Admin</span>
                                <?php elseif($user->role == 'penyewa'): ?>
                                    <span class="badge badge-primary badge-pill px-3 py-2">
                                        <i class="fas fa-user"></i> Penyewa
                                    </span>
                                <?php elseif($user->role == 'pemilik_sewa'): ?>
                                    <span class="badge badge-primary badge-pill px-3 py-2">
                                        <i class="fas fa-store"></i> Pemilik Sewa
                                    </span>
                                <?php else: ?>
                                    <input type="text" class="form-control" value="<?php echo e($user->role); ?>" readonly>
                                <?php endif; ?>                          
                        </div>
                        <div class="form-group">
                            <label for="verifyIdentitas" style="margin-right: 8px;">Verifikasi Identitas :</label>
                                <?php if($user->verifyIdentitas == 'Sudah'): ?>
                                    <span class="badge badge-success badge-pill px-3 py-2">Verified</spa>
                                <?php elseif($user->verifyIdentitas == 'Tidak'): ?>
                                    <span class="badge badge-warning badge-pill px-3 py-2">Unverified</span>
                                <?php elseif($user->verifyIdentitas == 'Ditolak'): ?>
                                    <span class="badge badge-danger badge-pill px-3 py-2">Rejected</span>
                                <?php else: ?>
                                    <input type="text" class="form-control" value="<?php echo e($user->verifyIdentitas); ?>" readonly>
                                <?php endif; ?>
                        </div>
                        <?php if($user->role == 'penyewa' || $user->role == 'pemilik_sewa'): ?>
                            <div class="form-group">
                                <label for="badge" style="margin-right: 8px;">Status :</label>
                                    <?php if($user->badge == 'Aktif'): ?>
                                        <span class="badge badge-success badge-pill px-3 py-2">
                                        <i class="fas fa-check"></i> Aktif</span>
                                    <?php elseif($user->badge == 'Banned'): ?>
                                        <span class="badge badge-danger badge-pill px-3 py-2">
                                        <i class="fas fa-ban"></i> Banned</span>
                                    <?php else: ?>
                                        <input type="text" class="form-control" value="<?php echo e($user->badge); ?>" readonly>
                                    <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="link_sosial_media">Link Sosial Media</label>
                                <a href="<?php echo e($user->link_sosial_media); ?>"
                                    target="_blank"><?php echo e($user->link_sosial_media); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Identitas User (hanya ditampilkan jika role bukan admin) -->
                    <?php if($user->role == 'penyewa' || $user->role == 'pemilik_sewa'): ?>
                        <div class="col-md-6">
                            <h4>Identitas User</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_profil">Foto Profil</label>
                                        <?php if($user->foto_profil): ?>
                                            <img src="<?php echo e(asset($user->foto_profil)); ?>" alt="Foto Profil"
                                                class="mt-2 d-block" width="150">
                                        <?php else: ?>
                                            <i class="fas fa-portrait fa-10x mt-2 d-block"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_diri">Foto Diri</label>
                                        <?php if($user->foto_diri): ?>
                                            <img src="<?php echo e(asset($user->foto_diri)); ?>" alt="Foto Diri" class="mt-2 d-block"
                                                width="150">
                                        <?php else: ?>
                                            <i class="fas fa-portrait fa-10x mt-2 d-block"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identitas">Identitas</label>
                                        <?php if($user->foto_identitas): ?>
                                             <a href="<?php echo e(asset($user->foto_identitas)); ?>" target="_blank">
                                                <img src="<?php echo e(asset($user->foto_identitas)); ?>" alt="Foto Identitas" class="mt-2 d-block" width="250">
                                            </a>
                                        <?php else: ?>
                                            <i class="fas fa-id-card fa-10x mt-2 d-block"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <input type="text" class="form-control" id="NIK" name="NIK"
                                    value="<?php echo e($user->NIK); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?php echo e($user->alamat); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="<?php echo e($user->provinsi); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota"
                                    value="<?php echo e($user->kota); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                    value="<?php echo e($user->kode_pos); ?>" readonly>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(Auth::check() && (
                    (Auth::user()->role === 'super_admin' && $user->role === 'admin') || 
                    Auth::user()->id === $user->id)): ?>
                    <button type="submit" class="btn btn-primary btn-block mb-2">Update</button>
                <?php else: ?>
                <?php endif; ?>
            </form>

            <!-- Tombol Delete -->
            <?php if(Auth::check()): ?>
                <?php if(Auth::user()->role === 'super_admin' && ($user->role == 'super_admin')): ?>
                    <!-- Super Admin tidak dapat mengklik tombol delete -->
                    <button type="button" class="btn btn-danger delete-btn btn-block mb-2" disabled>Delete</button>
                <?php elseif(Auth::user()->role === 'super_admin' || Auth::user()->id === $user->id): ?>
                    <!-- Super Admin atau user yang bersangkutan -->
                    <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                            onclick="confirmDelete('<?php echo e($user->id); ?>')" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                <?php elseif(Auth::user()->role === 'admin' && ($user->role == 'penyewa' || $user->role == 'pemilik_sewa')): ?>
                    <!-- Admin yang mengedit penyewa atau pemilik sewa -->
                    <button type="button" class="btn btn-danger delete-btn btn-block mb-2"
                            onclick="confirmDelete('<?php echo e($user->id); ?>')" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                <?php endif; ?>
            <?php endif; ?>


            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary btn-block">Kembali</a>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                    <br>
                <small style="color:red">Tindakan ini tidak dapat diurungkan!</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>

        </form>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.getElementById('password');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });


    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus user ini?');
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>