<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-5 mt-3">
                <div>
                    <h1 class="fw-bold text-secondary">Buat Ticketing Baru</h1>
                    <h5 class="fw-semibold text-secondary">Laporan permasalahan anda disini</h5>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h4 class="mb-5">Informasi Permasalahan</h4>
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
                    <form action="<?php echo e(route('seller.tiket.storeTicketingAction')); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class='form-group'>
                            <label for='kategori_tiket_id'>Kategori <span class='text-danger'>*</span></label>
                            <select name='kategori_tiket_id' id='kategori_tiket_id'
                                class='form-control <?php $__errorArgs = ['kategori_tiket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>' required>
                                <option value='' selected disabled>Pilih Kategori</option>
                                <?php $__currentLoopData = $data_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($kategori->id == old('kategori_tiket_id')): echo 'selected'; endif; ?> value='<?php echo e($kategori->id); ?>'><?php echo e($kategori->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['kategori_tiket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class='invalid-feedback'>
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class='form-group mb-3'>
                            <label for='deskripsi' class='mb-2'>Deskripsi Permasalahan <span
                                    class='text-danger'>*</span></label>
                            <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                class='form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>' required><?php echo e(old('deskripsi')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class='invalid-feedback'>
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class='form-group mb-3'>
                            <label for='bukti' class='mb-2'>Bukti <span class='text-danger'>*</span></label>
                            <input type='file' name='bukti[]' id='bukti'
                                class='form-control <?php $__errorArgs = ['bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>' value='<?php echo e(old('bukti')); ?>'
                                accept=".jpg,.png,.jpeg,.webp,.mp4" required>
                            <?php $__errorArgs = ['bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class='invalid-feedback'>
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div id="additional-file-upload"></div>
                        <button type="button" class="btn btn-outline kalasewa-color my-3" id="addFileButton">Tambah File
                            Bukti</button>
                        <div class="form-group mb-3">
                            <button class="btn btn-danger btn-block">Buat Ticketing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("addFileButton").addEventListener("click", function() {
            // Mendapatkan elemen id di view, untuk naroh input baru nya nanti
            const buktiInput = document.getElementById("additional-file-upload");
            // Membuat elemen div baru untuk input foto baru
            const newBuktiInput = document.createElement("div");
            // Menambahkan class bootstrap dan photo-input
            newBuktiInput.classList.add("bukti-input", "mb-2");
            // Memberikan ID unik ke elemen baru
            newBuktiInput.id = `bukti-${Date.now()}`;
            // Mengatur isi HTML dari div baru
            newBuktiInput.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="me-3">
                    <label for="bukti" class="mb-2">Bukti Tambahan</label>
                    <span class="btn" onclick="remove('bukti-${Date.now()}')"><i class="fas fa-trash"></i></span>
                </div>
            </div>
            <div class="flex-grow-1">
                <input type="file" name="bukti[]" class="form-control" id="fotoInput-${Date.now()}" accept=".jpg,.png,.jpeg,.webp">
                <div class="form-text error-message text-danger" id="FileError-${Date.now()}"></div>
            </div>`;
            // Menambahkan elemen baru ke dalam elemen dengan ID "photoInputs"
            buktiInput.appendChild(newBuktiInput);
        });

        function remove(id) {
            document.getElementById(id).remove();
        }
        // $(function() {
        //     $('#addFileButton').on('click', function(e) {
        //         e.preventDefault();
        //         var newFileUpload = $('<div class="form-group mb-3"></div>');
        //         var newLabel = $(
        //             '<label for="bukti" class="mb-2">Bukti Tambahan</label>'
        //         );
        //         var newFileInput = $(
        //             '<input type="file" name="bukti[]" class="form-control is-invalid">'
        //         );

        //         // Tambahkan label dan input file ke dalam div baru
        //         newFileUpload.append(newLabel);
        //         newFileUpload.append(newFileInput);

        //         // Tambahkan div baru ke dalam div dengan id 'additional-file-upload'
        //         $('#additional-file-upload').append(newFileUpload);
        //     });
        // })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.selllayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/pemilikSewa/iterasi3/tiket/createTicketing.blade.php ENDPATH**/ ?>