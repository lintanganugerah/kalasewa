<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3 ml-4">
                <!-- Tombol Back -->
                <div class="text-left mt-3 mb-4">
                    <a href="<?php echo e(route('seller.profil.viewPeraturanSewaToko')); ?>" class="btn btn-outline kalasewa-color"><i
                            class="fa-solid fa-arrow-left fa-regular me-2"></i>Kembali</a>
                </div>
                <h1 class="fw-bold text-secondary">Edit Peraturan Sewa</h1>
                <h4 class="fw-semibold text-secondary">Ubah Informasi Peraturan Sewa Anda</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
                                <h4 class="mb-3">Informasi Peraturan</h4>
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
                                <form action="<?php echo e(route('seller.profil.EditPeraturanSewaAction', $peraturan->id)); ?>"
                                    id="formproduk" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Peraturan<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="namaPeraturan" value="<?php echo e($peraturan->nama); ?>"
                                            <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum' ? 'disabled' : 'required'); ?>>
                                        <div id="namaPeraturan" class="form-text" style="opacity: 75%;">
                                            <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum'
                                                ? 'Maaf anda tidak dapat mengganti nama peraturan wajib ini'
                                                : 'Nama adalah kesimpulan dari penjelasan/deskripsi peraturan tersebut'); ?>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi Peraturan<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control"
                                            placeholder="Contoh : Jika ada bagian kostum yang rusak, aksesoris yang hilang, wig yang dipotong, dan sejenisnya. Maka harus mengganti barang asli atau seharga barang yang dihilangkan atau dirusak."
                                            id="deskripsi" rows="10" name="deskripsiPeraturan" required><?php echo e($peraturan->deskripsi); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apakah terdapat denda?</label><br>
                                        <input type="radio" id="dendaTidak" name="denda" value="tidak"
                                            onchange="toggleDendaOptions()"
                                            <?php echo e($peraturan->terdapat_denda == 0 ? 'checked' : ''); ?>

                                            <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum' ? 'disabled' : 'required'); ?>>
                                        Tidak
                                        <input type="radio" id="dendaYa" name="denda" value="ya"
                                            onchange="toggleDendaOptions()"
                                            <?php echo e($peraturan->terdapat_denda == 1 ? 'checked' : ''); ?>

                                            <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum' ? 'disabled' : ''); ?>>
                                        Ya
                                    </div>
                                    <div id="options" class="mb-3">
                                        
                                        <?php if($peraturan->terdapat_denda): ?>
                                            <div class="mb-2" id="optionsDendaPasti">
                                                <div class="mb-3">
                                                    <label class="form-label">Apakah denda memiliki nominal pasti?</label><a
                                                        data-bs-toggle="modal" data-bs-target="#infoModal"><i
                                                            class="fa-solid fa-regular fa-circle-info ms-2"></i></a><br>
                                                    <input type="radio" id="hargaPastiTidak" name="DendaPasti"
                                                        value="tidak" onchange="toggleDendaPastiOptions()"
                                                        <?php echo e($peraturan->denda_pasti == null ? 'checked' : ''); ?>

                                                        <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum' ? 'disabled' : 'required'); ?>>
                                                    Tidak
                                                    <input type="radio" id="DendaPastiYa" name="DendaPasti" value="ya"
                                                        onchange="toggleDendaPastiOptions()"
                                                        <?php echo e($peraturan->denda_pasti != null ? 'checked' : ''); ?>

                                                        <?php echo e($peraturan->nama == 'Terlambat Mengembalikan Kostum' ? 'disabled' : ''); ?>>
                                                    Ya
                                                </div>
                                                <?php if($peraturan->denda_pasti): ?>
                                                    <div class="Input-denda mb-2" id="DendaPastiNominal">
                                                        <label for="hargaInput" class="form-label">Denda<span
                                                                class="text-danger mb-3">*</span></label>
                                                        <small id="helpKeterangan" class="mb-3" style="opacity: 75%;">Jika
                                                            denda memiliki rentang harga, harap pilih opsi "tidak" pada
                                                            pertanyaan "Apakah denda memiliki nominal pasti?"</small>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="span_nominal">Rp.</span>
                                                            <input type="number" id="hargaInput" class="form-control"
                                                                name="nominal_denda" value="<?php echo e($peraturan->denda_pasti); ?>"
                                                                aria-label="Denda" pattern="[0-9]*" required>
                                                        </div>
                                                        <small id="helpnominal" class="mb-3" style="opacity: 75%;">Masukan
                                                            Angka Tanpa
                                                            Titik. Contoh : 50000</small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="Input-denda mb-2" id="DendaPastiDeskriptif">
                                                        <label for="hargaInput" class="form-label">Denda<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                name="nominal_denda"
                                                                value="<?php echo e($peraturan->denda_kondisional); ?>"
                                                                aria-label="Denda" required>
                                                        </div>
                                                        <small id="helpKeterangan" class="mb-3"
                                                            style="opacity: 75%;">Masukan secara deskripsi/teks. Jika
                                                            nominal
                                                            sudah pasti, pilih opsi "Ya" pada button diatas field denda
                                                            ini</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-grid mb-5 mt-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Buat
                                            Peraturan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoModalLabel">Informasi Denda</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="fw-bold">Saya bingung dengan pertanyaan ini.</h5>
                                    <ul>
                                        <li><strong>Jika denda memiliki rentang nominal atau harga denda tergantung suatu
                                                kondisi</strong>, pilih
                                            opsi <strong>Tidak</strong>. Berikan penjelasan secara deskriptif mengenai denda
                                            tersebut.
                                        </li>

                                        <li> <strong>Jika Anda sudah mengetahui pasti nominal denda</strong>, maka pilih
                                            opsi
                                            <strong>Ya</strong>. Pastikan Anda mengisi angka tanpa titik.
                                        </li>
                                    </ul>
                                    <p> Kedua tipe denda yang anda isikan ini nanti akan ditampilkan kepada penyewa
                                        sebelum melakukan sewa </p>

                                    <h5 class="fw-bold">Mengapa tipe denda dibedakan?</h5>
                                    <p>Ketika penyewa melanggar peraturan ini, Anda dapat mengajukan denda penyewaan. Anda
                                        akan memilih nama peraturan yang dilanggar dan biaya denda tersebut.</p>

                                    <ul>
                                        <li>Ketika peraturan memiliki denda dengan nominal yang sudah pasti, maka sistem
                                            akan
                                            otomatis menetapkan nominal denda tersebut sesuai yang Anda berikan sekarang.
                                            Seperti gambar dibawah ini: <br>
                                            <img src="<?php echo e(asset('storage/helper_foto/peraturan_pasti.png')); ?>"
                                                class="img-fluid">
                                            <br>
                                        </li>
                                        <br>
                                        <li>Sebaliknya, ketika nominal denda masih memiliki rentang atau tidak pasti, maka
                                            Anda harus mengisi secara manual nantinya pada saat pengajuan denda. Seperti
                                            dibawah ini: <br>
                                            <img src="<?php echo e(asset('storage/helper_foto/peraturan_tidak_pasti.png')); ?>"
                                                class="img-fluid">
                                            <br>
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
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('seller/optionDenda.js')); ?>"></script>
    <script src="<?php echo e(asset('seller/inputfotoproduk.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi2/peraturanSewa/editPeraturanSewaToko.blade.php ENDPATH**/ ?>