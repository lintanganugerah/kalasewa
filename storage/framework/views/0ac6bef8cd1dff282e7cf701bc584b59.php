<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $peraturans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($peraturan->Judul); ?></td>
                    <td><a href="<?php echo e(route('admin.regulations.edit', $peraturan->id)); ?>"
                            class="btn btn-primary btn-block">Ubah</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div><?php /**PATH /home/kalasewa/kalasewa/resources/views/admin/regulations/partials/table.blade.php ENDPATH**/ ?>