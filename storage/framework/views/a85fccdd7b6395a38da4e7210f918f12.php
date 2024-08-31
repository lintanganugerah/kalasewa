<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Produk</h1>
                <h4 class="fw-semibold text-secondary">Manajemen Produk Anda disini</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="Produkanda-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/produk/produkanda'" type="button" role="tab"
                                    aria-controls="Produkanda" aria-selected="true">Produk
                                    Anda</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-secondary fw-bold" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Tambah
                                    Produk</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
                                <h4 class="mb-3">Informasi Produk</h4>
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
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
                                <form action="<?php echo e(route('seller.tambahProdukAction')); ?>" id="formproduk" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="userPhoto" class="form-label">Foto Produk<span
                                                class="text-danger">*</span></label>
                                        <div id="photoInputs">
                                            <div class="photo-input mb-2">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3">
                                                        <img class="img-thumbnail" src=""
                                                            style="width: 150px; height: 150px; object-fit: cover;"
                                                            alt="Foto Produk">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" name="foto_produk[]"
                                                        class="form-control userPhoto" accept=".jpg,.png,.jpeg,.webp"
                                                        id="fotoInput-0" required>
                                                    <div class="form-text error-message text-danger" id="FileError-0"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="form-text text-muted">
                                                <ul>
                                                    <li>Disarankan Rasio foto 1:1 atau object berada di tengah</li>
                                                    <li>Ukuran max 5MB</li>
                                                    <li>JPG, JPEG, PNG, WEBP</li>
                                                </ul>
                                            </small>
                                        </div>
                                        <button type="button" id="addPhotoBtn" class="btn text-white"
                                            style="background-color: #D44E4E">Tambah Foto</button>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Produk<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="namaProduk" value="<?php echo e(old('namaProduk')); ?>"
                                            placeholder="Contoh: Yae Miko Genshin Impact" required>
                                        <div id="namaProduk" class="form-text" style="opacity: 50%;">Disarankan untuk
                                            memasukkan nama series pada
                                            produk agar penyewa gampang menemukan dari seris apa produks cosplay anda</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="deskripsiProduk" required><?php echo e(old('deskripsiProduk')); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Brand Kostum<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="brand" value="<?php echo e(old('brand')); ?>" required>
                                        <div id="HELPERBRAND" class="form-text" style="opacity: 75%;">Jika tidak ada
                                            brand
                                            silahkan tuliskan Maker Lokal/No Brand</div>
                                    </div>
                                    <label for="selectSeries" class="form-label">Series<span
                                            class="text-danger">*</span></label>
                                    <div class="form-floating mb-3">
                                        <select class="form-select select2" id="selectSeries" name="series" required>
                                            <option value="" disabled selected>Pilih atau
                                                ketik untuk menambahkan
                                                series baru</option>
                                            <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($sr->series); ?>"
                                                    <?php echo e(old('series') == $sr->series ? 'selected' : ''); ?>>
                                                    <?php echo e($sr->series); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label for="selectSeries">Series</label>
                                        <div id="namaProduk" class="form-text" style="opacity: 50%;">Jika series anda
                                            tidak
                                            ada. Silahkan ketik nama series lalu enter</div>
                                    </div>
                                    <label for="selectGender" class="form-label">Gender<span
                                            class="text-danger">*</span></label>
                                    <div class="mb-3">
                                        <select class="form-select" name="gender" required>
                                            <option value="" disabled selected style="opacity: 10%;">Kostum ini
                                                dipake oleh siapa?
                                            </option>
                                            <option value="Pria" <?php echo e(old('gender') == 'Pria' ? 'selected' : ''); ?>>Pria
                                            </option>
                                            <option value="Wanita" <?php echo e(old('gender') == 'Wanita' ? 'selected' : ''); ?>>
                                                Wanita</option>
                                            <option value="Semua Gender"
                                                <?php echo e(old('gender') == 'Semua Gender' ? 'selected' : ''); ?>>Semua Gender
                                            </option>
                                            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger form-text"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </select>
                                    </div>
                                    <label for="selectUkuran" class="form-label">Ukuran<span
                                            class="text-danger">*</span></label>
                                    <div class="mb-3">
                                        <select class="form-select" name="ukuran" required
                                            <?php $__errorArgs = ['ukuran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            style="border-color: #D44E4E;"
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                            <option value="" disabled selected>Apa ukuran kostum ini?</option>
                                            <option value="XS" <?php echo e(old('ukuran') == 'XS' ? 'selected' : ''); ?>>XS
                                            </option>
                                            <option value="S" <?php echo e(old('ukuran') == 'S' ? 'selected' : ''); ?>>S</option>
                                            <option value="M" <?php echo e(old('ukuran') == 'M' ? 'selected' : ''); ?>>M</option>
                                            <option value="L" <?php echo e(old('ukuran') == 'L' ? 'selected' : ''); ?>>L</option>
                                            <option value="XL" <?php echo e(old('ukuran') == 'XL' ? 'selected' : ''); ?>>XL
                                            </option>
                                            <option value="XXL" <?php echo e(old('ukuran') == 'XXL' ? 'selected' : ''); ?>>XXL
                                            </option>
                                            <option value="All_Size" <?php echo e(old('ukuran') == 'All_Size' ? 'selected' : ''); ?>>
                                                All Size</option>
                                        </select>
                                        <?php $__errorArgs = ['ukuran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <label for="hargaInput" class="form-label">Harga<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input type="number" id="hargaInput" class="form-control" name="harga"
                                                placeholder="Harga" pattern="[0-9]*" value="<?php echo e(old('harga')); ?>"
                                                required
                                                <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            style="border-color: #D44E4E;"
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                            <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger form-text"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <label for="hargaInput">Harga / 3
                                                hari</label>
                                        </div>
                                        <span id="harga_span" class="input-group-text fw-100">/ 3 hari</span>
                                    </div>
                                    <small id="helpberat" class="mb-3" style="opacity: 75%;">Masukan Tanpa
                                        Titik. Contoh : 150000
                                    </small>


                                    <hr class="border border-secondary border-3 my-5">
                                    <!-- Informasi Lainnya -->
                                    <h5>Informasi Tambahan Produk</h5>
                                    <div id="helpberat" class="mb-3" style="opacity: 75%;">Mohon masukkan infomasi
                                        tambahan produk dibawah ini. Klik icon i jika anda bingung mengenai field
                                        tersebut</div>
                                    <label for="grade" class="form-label">Grade Kostum<span
                                            class="text-danger">*</span></label><a data-bs-toggle="modal"
                                        data-bs-target="#infoModalGrade"><i
                                            class="fa-solid fa-regular fa-circle-info ms-2"></i></a>
                                    <div class="mb-3">
                                        <select class="form-select" name="grade" required>
                                            <option value="" disabled selected style="opacity: 10%;">Berapa grade
                                                kostum ini?
                                            </option>
                                            <option value="Grade 1" <?php echo e(old('grade') == 'Grade 1' ? 'selected' : ''); ?>>
                                                Grade 1
                                            </option>
                                            <option value="Grade 2" <?php echo e(old('grade') == 'Grade 2' ? 'selected' : ''); ?>>
                                                Grade 2</option>
                                            <option value="Grade 3" <?php echo e(old('Grade 3') == 'Grade 3' ? 'selected' : ''); ?>>
                                                Grade 3
                                            </option>
                                            <?php $__errorArgs = ['grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger form-text"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </select>
                                    </div>
                                    <label for="biaya_cuci" class="form-label">Apakah ada biaya cuci untuk kostum
                                        ini?<span class="text-danger">*</span></label><a data-bs-toggle="modal"
                                        data-bs-target="#infoModalCuci"><i
                                            class="fa-solid fa-regular fa-circle-info ms-2"></i></a>
                                    <div class="mb-3">
                                        <input type="radio" id="cuciTidak" name="cuci" value="tidak"
                                            onchange="opsiCuci()" <?php echo e(old('cuci') == 'tidak' ? 'checked' : ''); ?> required>
                                        Tidak
                                        <input type="radio" id="cuciYa" name="cuci" value="ya"
                                            onchange="opsiCuci()" <?php echo e(old('cuci') == 'ya' ? 'checked' : ''); ?>> Ya
                                        <?php $__errorArgs = ['cuci'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger form-text"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div id="optionsBiayaCuci" class="mb-3">
                                        

                                        <?php if(old('biaya_cuci')): ?>
                                            <div class="mb-2" id="optionsCuci">
                                                <label for="biaya_cuci" class="form-label">Biaya Cuci<span
                                                        class="text-danger mb-3">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="span_nominal">Rp.</span>
                                                    <input type="number" id="biaya_cuci" class="form-control"
                                                        name="biaya_cuci" placeholder="20000" aria-label="cuci"
                                                        pattern="[0-9]*" value="<?php echo e(old('biaya_cuci')); ?>" required>
                                                </div>
                                                <small id="helpnominal" class="mb-3" style="opacity: 75%;">Masukan
                                                    Angka Tanpa
                                                    Titik. Contoh : 20000</small>
                                                <?php $__errorArgs = ['biaya_cuci'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger form-text"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <label for="wig" class="form-label">Apakah katalog produk ini termasuk wig
                                        dalam penyewaan?<span class="text-danger">*</span></label><a
                                        data-bs-toggle="modal" data-bs-target="#infoModalWig"><i
                                            class="fa-solid fa-regular fa-circle-info ms-2"></i></a>
                                    <div class="mb-3">
                                        <input type="radio" id="wigTidak" name="wig_opsi" value="tidak"
                                            onchange="opsiWig()" <?php echo e(old('wig_opsi') == 'tidak' ? 'checked' : ''); ?>

                                            required> Tidak
                                        <input type="radio" id="wigYa" name="wig_opsi" value="ya"
                                            onchange="opsiWig()" <?php echo e(old('wig_opsi') == 'ya' ? 'checked' : ''); ?>> Ya
                                    </div>
                                    <div id="optionsWig" class="mb-3">
                                        

                                        <?php if(old('brand_wig') || old('ket_wig')): ?>
                                            <div class="mb-2" id="infoWig">
                                                <div class="mb-3">
                                                    <label for="brand_wig" class="form-label">Brand wig<span
                                                            class="text-danger mb-3">*</span></label>
                                                    <input type="text" id="brand_wig" class="form-control"
                                                        name="brand_wig" aria-label="brand_wig"
                                                        value="<?php echo e(old('brand_wig')); ?>" required>
                                                    <small id="helpnominal" class="mb-3" style="opacity: 75%;">Masukan
                                                        No Brand jika tidak ada brand</small>
                                                    <?php $__errorArgs = ['brand_wig'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="text-danger form-text"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ket_wig" class="form-label">Keterangan Styling Wig<span
                                                            class="text-danger mb-3">*</span></label>
                                                    <input type="text" id="ket_wig"
                                                        placeholder="Soft Styling/Hard Styling/No Styling"
                                                        class="form-control" name="ket_wig" aria-label="ket_wig"
                                                        value="<?php echo e(old('ket_wig')); ?>" required>
                                                    <?php $__errorArgs = ['ket_wig'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="text-danger form-text"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($alamatTambahan): ?>
                                        <hr class="border border-secondary border-3 my-5">
                                        <!-- Informasi Alamat -->
                                        <h5>Informasi Alamat</h5>
                                        <div id="helpberat" class="mb-3" style="opacity: 75%;">Anda memiliki alamat
                                            tambahan. Mohon pilih dimana produk/kostum ini berada</div>
                                        <label for="ket_wig" class="form-label">Dimana Alamat Produk ini?<span
                                                class="text-danger mb-3">*</span></label>
                                        <div class="mb-3">
                                            <input type="radio" id="default_alamat" name="alamat_opsi" value="default"
                                                <?php echo e(old('alamat_opsi') == 'default' ? 'checked' : ''); ?> required>
                                            Alamat Utama
                                            <?php $__currentLoopData = $alamatTambahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $al): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input type="radio" name="alamat_opsi" value="<?php echo e($al->id); ?>"
                                                    <?php echo e(old('alamat_opsi') == $al->id ? 'checked' : ''); ?> required>
                                                <?php echo e($al->nama); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>

                                    <hr class="border border-secondary border-3 my-5">
                                    <!-- Informasi Additional -->
                                    <h5>Informasi Barang Additional</h5>
                                    <div id="helpberat" class="mb-3" style="opacity: 75%;">Jika Anda memiliki
                                        tambahan barang misalnya seperti aksesoris tambahan, masukan informasi tersebut
                                        disini beserta harga</div>
                                    <div id="additionalInputs" class="mb-3">
                                        <!-- Kontainer untuk input harga dan stok yang akan ditambahkan secara dinamis -->
                                        <!-- Kalo salah bakal looping ngisi value sebelumnya -->
                                        <?php if(old('additional')): ?>
                                            <?php for($i = 0; $i < count(old('additional')); $i += 2): ?>
                                                <div class="additional-input mb-3" id="additional-<?php echo e($i); ?>">
                                                    <div class="fw-bolder fs-5">Additional <span class="btn"
                                                            onclick="removeAdditionalInput('additional-<?php echo e($i); ?>')"><i
                                                                class="fas fa-trash"></i></span></div>
                                                    <div class="form-group">
                                                        <label for="additionalName-<?php echo e($i); ?>">Nama
                                                            Additional</label>
                                                        <input type="text" class="form-control"
                                                            id="additionalName-<?php echo e($i); ?>" name="additional[]"
                                                            value="<?php echo e(old('additional')[$i]); ?>" required
                                                            <?php $__errorArgs = ['add' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            style="border-color:#D44E4E"
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                                        <?php $__errorArgs = ['add' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger form-text"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="additionalHarga_<?php echo e($i + 1); ?>">Harga
                                                            Additional</label>
                                                        <input type="number" pattern="^[0-9]*$"
                                                            class="form-control additional-price"
                                                            id="additionalPrice-<?php echo e($i + 1); ?>" name="additional[]"
                                                            value="<?php echo e(old('additional')[$i + 1]); ?>" required
                                                            <?php $__errorArgs = ['add' . $i + 1];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            style="border-color:#D44E4E"
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                                        <?php $__errorArgs = ['add' . $i + 1];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger form-text"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <small class="mb-3" style="opacity: 75%;">Masukan Tanpa
                                                            Titik</small>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" id="addAdditional" class="btn btn-outline"
                                        style="color: #D44E4E">Tambah</button>
                                    <hr class="border border-secondary border-3 my-5">
                                    <!-- Informasi Pengiriman -->
                                    <h5 class="card-title">Informasi Pengiriman</h5>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Berat Produk<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" pattern="[0-9]*"
                                            value="<?php echo e(old('beratProduk')); ?>" id="beratProduk" name="beratProduk"
                                            required
                                            <?php $__errorArgs = ['beratProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            style="border-color: #D44E4E;"
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                                        <?php $__errorArgs = ['beratProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div id="helpberat" class="form-text" style="opacity: 75%;">Masukan dalam
                                            satuan
                                            gram. 1000 = 1kg. Tanpa titik</div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Metode Pengiriman<span
                                                class="text-danger">*</span></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="grab"
                                                value="Grab" name="metode_kirim[]"
                                                <?php echo e(in_array('Grab', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="grab">Grab</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="goSend"
                                                value="GoSend" name="metode_kirim[]"
                                                <?php echo e(in_array('GoSend', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="goSend">GoSend</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jne"
                                                value="JNE" name="metode_kirim[]"
                                                <?php echo e(in_array('JNE', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="jne">JNE</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jnt"
                                                value="JNT" name="metode_kirim[]"
                                                <?php echo e(in_array('JNT', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="jnt">JNT</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="SiCepat"
                                                value="SiCepat" name="metode_kirim[]"
                                                <?php echo e(in_array('SiCepat', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="SiCepat">SiCepat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="Paxel"
                                                value="Paxel" name="metode_kirim[]"
                                                <?php echo e(in_array('Paxel', old('metode_kirim', [])) ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="Paxel">Paxel</label>
                                        </div>
                                        <div class="text-danger form-text" style="visibility:hidden;" id="option_error">
                                            Harap
                                            Pilih Metode Kirim</div>
                                    </div>
                                    <div class="d-grid mb-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Buat
                                            Produk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Modal Grade -->
                    <div class="modal fade" id="infoModalGrade" tabindex="-1" aria-labelledby="infoModalGradeLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoModalGradeLabel">Informasi Grade Kostum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-bold">Apa Itu Grade Kostum ?</p>
                                    <p>Sistem grade digunakan untuk membedakan kostum-kostum berdasarkan tingkat
                                        kompleksitas, kualitas, dan harga, serta untuk menentukan siapa yang memenuhi syarat
                                        untuk menyewa setiap grade kostum tersebut.</p>

                                    <p><span class="fw-bold">Jika penyewa
                                            tidak memenuhi syarat,
                                            maka ia tidak akan bisa merental kostum tersebut.</span> Berikut adalah
                                        penjelasan mengenai
                                        sistem grade yang kami terapkan:</p>

                                    <p class="fw-bold">Grade 1</p>
                                    <ul>
                                        <li><span class="fw-bold">Syarat Penyewa :</span> Dapat disewa oleh siapa saja,
                                            termasuk penyewa baru atau newbie.
                                        </li>
                                        <li>Sebaiknya anda memberikan grade 1 untuk kostum yang memiliki brand
                                            standar/low-end, dengan aksesoris yang sedikit. Namun, keputusan penuh ada di
                                            tangan anda untuk menentukan apakah kostum yang anda rental cocok di grade 1
                                            ini.
                                        </li>
                                    </ul>
                                    <p class="fw-bold">Grade 2</p>
                                    <ul>
                                        <li><span class="fw-bold">Syarat Penyewa :</span> Hanya bisa disewa oleh pelanggan
                                            yang sudah memiliki pengalaman menyewa di kalasewa sebelumnya.
                                        </li>
                                        <li>Penyewa baru atau newbie tidak dapat bisa merental kostum dengan grade 2 ini.
                                        </li>
                                    </ul>

                                    <p class="fw-bold">Grade 3</p>
                                    <ul>
                                        <li><span class="fw-bold">Syarat Penyewa :</span> Hanya bisa disewa oleh pelanggan
                                            yang sudah memiliki pengalaman menyewa di kalasewa sebelumnya sebanyak 3x, dan
                                            penyewa memiliki
                                            rating review setidaknya 4. Setiap toko wajib memberikan rating penyewa setiap
                                            selesai penyewaan, sehingga pasti akan ada rating untuk penyewa
                                        </li>
                                        <li>Penyewa baru atau newbie tidak dapat merental kostum dengan grade 3 ini.
                                            Penyewa yang belum memiliki pengalaman di kalasewa, dan
                                            memiliki rating dibawah 4 maka tidak dapat menyewa kostum grade ini.
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Cuci -->
                    <div class="modal fade" id="infoModalCuci" tabindex="-1" aria-labelledby="infoModalCuciLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoModalCuciLabel">Informasi Cuci Kostum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Jika kostum anda memiliki biaya cuci, silahkan tekan ya. <span class="fw-bold">Biaya
                                            cuci akan otomatis
                                            tertambah pada saat penyewa checkout kostum anda. </span> Sehingga nanti harga
                                        kostum + biaya laundry akan dikenakan kepada penyewa</p>
                                    <p>Namun jika anda tidak memiliki biaya ini, maka cukup pilih "Tidak" pada opsi yang
                                        diberikan</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Wig -->
                    <div class="modal fade" id="infoModalWig" tabindex="-1" aria-labelledby="infoModalWigLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoModalWigLabel">Informasi Wig</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><span class="fw-bold">Jika katalog produk ini sudah termasuk wig, silahkan tekan
                                            "ya" pada opsi.</span> Lalu inputkan informasi brand wig, beserta keterangan
                                        styling wig anda. </p>
                                    <p>Informasi wig ini akan terpampang secara jelas kepada penyewa untuk memberikan
                                        informasi tambahan mengenai apa brand (kualitas) wig yang anda berikan kepada
                                        pelanggan saat penyewaan, dan tipe styling nya</p>
                                    <p>Namun jika anda tidak menyertakan wig pada katalog produk ini, maka cukup pilih
                                        "Tidak" pada opsi yang
                                        diberikan</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            height: $(this).data('height') ? $(this).data('height') : $(this).hasClass('h-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            tags: true,
            createTag: function(params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                };
            }
        });
    </script>
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/produk/tambahproduk.blade.php ENDPATH**/ ?>