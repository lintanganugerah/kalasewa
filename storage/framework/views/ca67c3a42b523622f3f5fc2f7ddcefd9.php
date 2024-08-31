<?php $__env->startSection('title', 'Ticket Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Ticket</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen Ticket</li>
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

<a href="<?php echo e(route('admin.ticket.category')); ?>" class="btn btn-primary mb-4">Lihat Kategori</a>

<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">Ticket Request</h5>
        <div class="table-responsive">
            <?php if($tickets->isEmpty()): ?>
                <p>Sedang tidak ada permintaan tiket.</p>
            <?php else: ?>
                <table class="table table-bordered" id="tickets-table">
                    <thead class="text-center align-middle">
                        <tr>
                            <th style="width: 5%;" class="text-center align-middle">No Tiket</th>
                            <th style="width: 15%;" class="text-center align-middle">Dibuat Tanggal</th>
                            <th style="width: 30%;" class="text-center align-middle">Nama</th>
                            <th style="width: 30%;" class="text-center align-middle">Kategori Tiket</th>
                            <th style="width: 10%;" class="text-center align-middle">Status</th>
                            <th style="width: 10%;" class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center align-middle">
                                <td class="text-center align-middle"><?php echo e($ticket->id); ?></td>
                                <td class="text-center align-middle">
                                    <?php echo e(\Carbon\Carbon::parse($ticket->updated_at)->translatedFormat('j F Y, H:i')); ?>

                                </td>
                                <td class="text-center align-middle"><?php echo e($ticket->user->nama); ?></td>
                                <td class="text-center align-middle"><?php echo e($ticket->kategori->nama); ?></td>
                                <td class="text-center align-middle">
                                    <?php if($ticket->status === 'Menunggu Konfirmasi'): ?>
                                        <span class="badge badge-primary"><?php echo e(ucfirst($ticket->status)); ?></span>
                                    <?php elseif($ticket->status === 'Sedang Diproses'): ?>
                                        <span class="badge badge-warning"><?php echo e(ucfirst($ticket->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($ticket->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?php echo e(route('admin.ticket.show', $ticket->id)); ?>"
                                        class="btn btn-primary btn-block">Tampilkan</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">History</h5>
        <div class="table-responsive">
            <?php if($completedOrRejectedTickets->isEmpty()): ?>
                <p>Belum ada tiket selesai atau ditolak.</p>
            <?php else: ?>
                <table class="table table-bordered" id="history-tickets-table">
                    <thead class="text-center align-middle">
                        <tr>
                            <th style="width: 5%;" class="text-center align-middle">No Tiket</th>
                            <th style="width: 15%;" class="text-center align-middle">Dibuat Tanggal</th>
                            <th style="width: 30%;" class="text-center align-middle">Nama</th>
                            <th style="width: 30%;" class="text-center align-middle">Kategori Tiket</th>
                            <th style="width: 10%;" class="text-center align-middle">Status</th>
                            <th style="width: 10%;" class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        <?php $__currentLoopData = $completedOrRejectedTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center align-middle">
                                <td class="text-center align-middle"><?php echo e($ticket->id); ?></td>
                                <td class="text-center align-middle">
                                    <?php echo e(\Carbon\Carbon::parse($ticket->created_at)->translatedFormat('j F Y, H:i')); ?>

                                </td>
                                <td class="text-center align-middle"><?php echo e($ticket->user->name); ?></td>
                                <td class="text-center align-middle"><?php echo e($ticket->kategori->nama); ?></td>
                                <td class="text-center align-middle">
                                    <?php if($ticket->status === 'Ditolak'): ?>
                                        <span class="badge badge-danger"><?php echo e(ucfirst($ticket->status)); ?></span>
                                    <?php elseif($ticket->status === 'Selesai'): ?>
                                        <span class="badge badge-success"><?php echo e(ucfirst($ticket->status)); ?></span>
                                    <?php else: ?>
                                        <?php echo e(ucfirst($ticket->status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?php echo e(route('admin.ticket.show', $ticket->id)); ?>"
                                        class="btn btn-primary btn-block">Tampilkan</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\kalasewa hosting iterasi 3 v1\resources\views/admin/ticket/index.blade.php ENDPATH**/ ?>