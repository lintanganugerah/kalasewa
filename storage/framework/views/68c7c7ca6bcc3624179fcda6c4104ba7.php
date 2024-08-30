<?php if($topseries->isNotEmpty()): ?>
    <table class="table w-100 table-borderless table-responsive">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Nama Series</th>
                <th width="4%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $topseries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idseries => $series): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="align-middle">
                        #<?php echo e($loop->iteration); ?>

                    </td>
                    <td class="align-middle">
                        <div>
                            <h5 class="cut-text"><?php echo e($series->first()->series->series); ?>

                            </h5>
                        </div>
                    </td>
                    <td class="align-middle">
                        <p class="m-0 small fw-bold card-link" href="#">
                            <?php echo e($series->first()->banyak_dipesan); ?>x disewa</p>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p> Belum ada top series</p>
<?php endif; ?>
<?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\kalasewa hosting iterasi 3 v1\resources\views/pemilikSewa/iterasi3/topseries_tabel.blade.php ENDPATH**/ ?>