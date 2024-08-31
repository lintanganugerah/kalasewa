<?php $__env->startSection('content'); ?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <div class="h1 fw-bold mb-3">Register Sebagai Pemilik Sewa</div>
                <div class="h3 fw-bold mb-0">Mohon isi informasi Anda</div>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">
                    <!-- FORM REGISTER PERTAMA -->
                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="<?php echo e(route('registerInformationActionPemilikSewa')); ?>" method="POST"
                                enctype="multipart/form-data" id="registerForm">
                                <?php echo csrf_field(); ?>
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                    <input type="text" id="email" class="form-control form-control-lg" name="email"
                                        value="<?php echo e(session('email')); ?>" disabled />
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="validpassword" class="form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="validpassword" name="password"
                                            minlength="8" value="<?php echo e(old('password')); ?>" required>
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password"
                                            onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon"></i></button>
                                    </div>
                                    <div class="form-text">
                                        Password harus memiliki panjang 8 karakter, memiliki huruf kapital, angka, dan
                                        simbol
                                    </div>
                                    <div class="form-text error-message text-danger" id="passwordError"></div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" class="form-control error-check"
                                            name="password_confirmation" minlength="8"
                                            value="<?php echo e(old('password_confirmation')); ?>" required />
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="toggle-password-konfirmasi" onclick="konfirmasitogglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon-konfirmasi"></i></button>
                                    </div>
                                    <div class="form-text error-message text-danger" id="konfirmasi_error"></div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="password_confirmation">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <h5 class="fw-bold pb-3" style="letter-spacing: 1px;">Informasi Pribadi
                                </h5>

                                <div class="d-grid">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Foto KTP<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="formFile" name="foto_identitas"
                                            accept=".jpg,.png,.jpeg,.webp">
                                        <div id="HELP" class="form-text">Dapat Menggunakan Kartu Identitas Orang
                                            Tua/Wali
                                            jika anda masih dibawah umur</div>
                                        <div class="form-text error-message text-danger" id="FileError"></div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Sesuai Identitas<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control form-control-lg error-check"
                                        name="nama" value="<?php echo e(old('nama')); ?>" required />
                                    <div id="HELP" class="form-text">Nama harus sesuai dengan foto yang di upload!
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="NIK">Nomor Identitas (NIK)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="NIK" class="form-control form-control-lg error-check"
                                        name="nomor_identitas" pattern="[0-9]*" minlength="16"
                                        value="<?php echo e(old('nomor_identitas')); ?>" required
                                        <?php $__errorArgs = ['nomor_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> />
                                    <div id="HELP" class="form-text">Nomor Identitas harus sesuai dengan foto yang di
                                        upload!</div>
                                    <div class="form-text error-message text-danger" id="NIKError"></div>
                                    <?php $__errorArgs = ['nomor_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="nomor_identitas">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Toko
                                </h5>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="namaToko">Nama Toko<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="namaToko" class="form-control form-control-lg error-check"
                                        name="namaToko" value="<?php echo e(old('namaToko')); ?>" required
                                        <?php $__errorArgs = ['namaToko'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> />
                                    <?php $__errorArgs = ['namaToko'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="namaToko">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="linkSosmed">Link Sosial Media<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="linkSosmed"
                                        class="form-control form-control-lg error-check" name="link_sosial_media"
                                        value="<?php echo e(old('link_sosial_media')); ?>" required
                                        <?php $__errorArgs = ['link_sosial_media'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> />
                                    <div id="link_helper" class="form-text">Link Sosial media valid lengkap dengan
                                        "https://". Contoh
                                        https://www.instagram.com/akun_anda/
                                    </div>
                                    <?php $__errorArgs = ['link_sosial_media'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="link_sosial_media">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nomor_telpon">Nomor Telpon Toko<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nomor_telpon"
                                        class="form-control form-control-lg error-check" name="nomor_telpon"
                                        pattern="[0-9]*" minlength="10" maxlength="13"
                                        value="<?php echo e(old('nomor_telpon')); ?>" required
                                        <?php $__errorArgs = ['nomor_telpon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> />
                                    <div id="HELP" class="form-text">Harap masukkan nomor telpon toko yang dapat
                                        dihubungi!
                                    </div>
                                    <?php $__errorArgs = ['nomor_telpon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="nomor_telpon">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-text error-message text-danger" id="nomorTelponError"></div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example27">Alamat Toko<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" id="alamat" class="form-control form-control-lg error-check" name="AlamatToko" required
                                        <?php $__errorArgs = ['AlamatToko'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color:#D44E4E"
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>><?php echo e(old('AlamatToko')); ?></textarea>
                                    <div id="HELP" class="form-text">Harap masukkan alamat toko secara valid untuk
                                        keperluan
                                        informasi pengiriman!</div>
                                    <?php $__errorArgs = ['AlamatToko'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="AlamatToko">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select error-check" id="provinsi" name="provinsi"
                                        aria-label="Floating label select example" required
                                        <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                        <option selected> </option>
                                        <option value="Jawa Barat"
                                            <?php echo e(old('provinsi') == 'Jawa Barat' ? 'selected' : ''); ?> selected>
                                            Jawa Barat
                                        </option>
                                    </select>
                                    <label for="provinsi">Provinsi<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="provinsi">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select error-check" id="kotaSelect" name="kota"
                                        aria-label="Floating label select example" required
                                        <?php $__errorArgs = ['kota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                        <option selected> </option>
                                        <option value="Kota Bandung"
                                            <?php echo e(old('kota') == 'Kota Bandung' ? 'selected' : ''); ?> selected>
                                            Kota Bandung</option>
                                        <option value="Kabupaten Bandung"
                                            <?php echo e(old('kota') == 'Kabupaten Bandung' ? 'selected' : ''); ?>>Kabupaten
                                            Bandung
                                        </option>
                                    </select>
                                    <label for="kota">Kota/Kabupaten<span class="text-danger">*</span></label>
                                    <?php $__errorArgs = ['kota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="kota">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="d-grid mb-5">
                                    <!--<div class="form-outline">-->
                                    <!--    <label class="form-label" for="kodePos">Kode Pos<span-->
                                    <!--            class="text-danger">*</span></label>-->
                                    <!--    <input type="text" id="kodePos" class="form-control error-check"-->
                                    <!--        name="kodePos" pattern="[0-9]*" minlength="5" maxlength="5"-->
                                    <!--        value="<?php echo e(old('kodePos')); ?>" required-->
                                    <!--        <?php $__errorArgs = ['kodePos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color:#D44E4E" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> />-->
                                    <!--</div>-->
                                    <select class="form-select select2" id="kodePos" name="kodePos"
                                            pattern="[0-9]*" id="kodePos" minlength="5"
                                            <?php $__errorArgs = ['kodePos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red;" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> maxlength="5" data-kodePos="<?php echo e(old('kodePos')); ?>" required>
                                        <option value="" selected disabled>Pilih Kode Pos</option>
                                    </select>
                                    <div class="form-text error-message text-danger" id="kodePosError"></div>
                                    <?php $__errorArgs = ['kodePos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger form-text error-message" data-milik="kodePos">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="d-grid mb-5">
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-kalasewa btn-lg btn-block" type="submit">Daftar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        
        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="<?php echo e(asset('seller/validasiRegisPemilik.js')); ?>"></script>
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('validpassword');
                const toggleIcon = document.getElementById('toggle-icon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
    
            function konfirmasitogglePassword() {
                const passwordInput = document.getElementById('password_confirmation');
                const toggleIcon = document.getElementById('toggle-icon-konfirmasi');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>
        <script>
            $('.select2').select2({
                theme: "bootstrap-5",
                width: '100%', // Ensure width is properly set
                placeholder: "Kode Pos", // Set placeholder for size
            });
        </script>
        <script src="<?php echo e(asset('seller/kode_pos.js')); ?>"></script>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/authentication/register-pemiliksewa-informasi.blade.php ENDPATH**/ ?>