<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laporan</title>
    <style>
        /* Basic Reset */
        @page {
            size: A4 landscape;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            font-weight: 500;
            line-height: 1.2;
        }

        p {
            margin: 0 0 1rem;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Containers */
        .container {
            max-width: 95vh;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Grid Container */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        /* Default Column Width */
        .col {
            flex: 0 0 100%;
            max-width: 100%;
        }

        /* Custom alignment */
        .text-right {
            text-align: right !important;
        }

        /* Typography */
        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .fw-light {
            font-weight: 300;
        }

        /* Tables */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .highlight {
            background-color: #f9f9f9;
        }

        /* Lists */
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul li {
            margin-bottom: 0.5rem;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        /* Responsive Table */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
        }

        .align-middle {
            vertical-align: middle !important;
            /* Untuk align vertikal di tengah */
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top : 40px; margin-bottom : 40px">
        <div class="container">
            <div class="row">
                <div class="col" style="margin-top: 20px; margin-bottom: 20px">
                    <h4>Toko:</h4> <?php echo e(auth()->user()->toko->nama_toko); ?>

                </div>
            </div>
        </div>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $months): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <hr style="width: 100%;">
            <h2 class="text-center" style="margin-top : 40px; margin-bottom : 40px">Laporan Penghasilan Tahun
                <?php echo e($year); ?></h2>
            <hr style="width: 100%;">
            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $bulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mt-4" style="margin-top : 20px; margin bottom : 20px">
                    <h3 style="background-color: #f0f0f0; width: 100vw; padding: 10px; margin: 0;">
                        Bulan <?php echo e($month); ?> Tahun <?php echo e($year); ?>

                    </h3>
                    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="row" style="display: flex; justify-content: flex-end; align-items: center;">
                            <div class="col" style="margin-left: 20px;">
                                <h4>Total Order:</h4> <?php echo e($bulan->count()); ?>

                            </div>
                            <div class="col" style="margin-left: 20px;">
                                <h4>Total Penghasilan:</h4> Rp <?php echo e($bulan->sum('total_penghasilan')); ?>

                            </div>
                        </div>
                    </div>
                    <table class="table" style="margin-top : 20px; margin bottom : 20px">
                        <thead>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Produk</th>
                                <th>Harga Sewa</th>
                                <th>Total Additional</th>
                                <th>Fee Admin (5%)</th>
                                <th>Biaya Cuci</th>
                                <th>Ongkir</th>
                                <th>Denda Keterlambatan</th>
                                <th>Denda Lainnya</th>
                                <th>Total Penghasilan Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle"><?php echo e($item->created_at); ?></td>
                                    <td class="align-middle"><?php echo e($item->produk->nama_produk); ?>

                                        <small class="fw-light" style="font-size:14px"><?php echo e($item->produk->brand); ?>,
                                            Rp <?php echo e(number_format($item->produk->harga, 0, '', '.')); ?>/3hari, Ukuran
                                            <?php echo e($item->produk->ukuran_produk); ?>

                                        </small>
                                    </td>
                                    <td class="align-middle"><?php echo e(number_format($item->produk->harga, 0, '', '.')); ?>

                                    </td>
                                    <td class="align-middle">
                                        <?php if($item->additional): ?>
                                            <ul>
                                                <?php $__currentLoopData = $item->additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($add['nama']); ?> +
                                                        <?php echo e(number_format($add['harga'], 0, '', '.')); ?>

                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            Rp <?php echo e(number_format(0, 0, '', '.')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">Rp <?php echo e(number_format($item->fee_admin, 0, '', '.')); ?>

                                    </td>
                                    <td class="align-middle">Rp
                                        <?php echo e(number_format($item->biaya_cuci ?? 0, 0, '', '.')); ?>

                                    </td>
                                    <td class="align-middle">Rp
                                        <?php echo e(number_format($item->ongkir_pengiriman ?? 0, 0, '', '.')); ?></td>
                                    <td class="align-middle">Rp
                                        <?php echo e(number_format($item->denda_keterlambatan ?? 0, 0, '', '.')); ?></td>
                                    <td class="align-middle">Rp
                                        <?php echo e(number_format($item->denda_penyewa ?? 0, 0, '', '.')); ?></td>
                                    <td class="align-middle">Rp
                                        <?php echo e(number_format($item->total_penghasilan ?? 0, 0, '', '.')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr class="highlight">
                                <td colspan="9" class="text-end">Total Penghasilan Bersih Bulan
                                    <?php echo e($month); ?> <?php echo e($year); ?>:
                                </td>
                                <td class="align-middle">Rp <?php echo e($bulan->sum('total_penghasilan')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="page-break"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="footer mx-4 mt-4">
        <div>&copy; Kalasewa</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Revisi\revisi kalasewa v2\resources\views/pemilikSewa/iterasi3/keuangan/laporan.blade.php ENDPATH**/ ?>