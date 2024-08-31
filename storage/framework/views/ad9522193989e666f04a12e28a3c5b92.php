<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/series.css')); ?>" />

<section>
    <div class="main-container container">
        <div class="row py-5">
            <div class="header">
                <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="kalasewa" class="header-image">
                <h1>K A L A S E W A</h1>
                <h4>Wujudkan impian cosplaymu bersama-sama!</h4>
            </div>
        </div>

        <div class="row">
            <h1 class="text-center mb-3"><strong>SERIES</strong></h1>
            <div class="list-group">
                <div class="container gap-2 series-container">
                    <?php $__currentLoopData = $groupedSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter => $seriesGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="series-group">
                            <h4 class="series-letter text-center"><?php echo e($letter); ?></h4>
                            <div class="container">
                                <div
                                    class="row row-cols-2 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-2  d-flex justify-content-start">
                                    <?php $__currentLoopData = $seriesGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seriesItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col">
                                            <a href="<?php echo e(route('search', ['series' => $seriesItem->id])); ?>"
                                                class="list-group-item list-group-item-action"
                                                style="border-radius: 5px;"><?php echo e($seriesItem->series); ?></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalasewa/kalasewa/resources/views/series.blade.php ENDPATH**/ ?>