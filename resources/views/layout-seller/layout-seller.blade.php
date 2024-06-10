<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalasewa Seller</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.css">

    <style>
    .custom-bg-gradient {
        background: linear-gradient(180deg, #e9ecef, #ced4da);
        min-height: 100vh;
    }

    .btn-outline:hover {
        background-color: #14496C;
        color: white !important;
    }

    .btn-outline {
        border-color: #394858;
        color: #394858
    }

    .btn-kalasewa {
        background-color: #EE1B2F;
        color: white;
    }

    @media only screen and (max-width: 1000px) {

        /* Force table to not be like tables anymore */
        .no-more-tables table,
        .no-more-tables thead,
        .no-more-tables tbody,
        .no-more-tables th,
        .no-more-tables td,
        .no-more-tables tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .no-more-tables thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .no-more-tables tr {
            border: 1px solid #ccc;
        }

        .no-more-tables td {
            /* Behave like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            white-space: normal;
            text-align: left;
        }

        .no-more-tables td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 100%;
            padding-right: 10px;
            text-align: left;
            font-weight: bold;
        }

        /* Label the data */
        .no-more-tables td:before {
            content: attr(data-title);
        }

        .no-more-tables tbody tr {
            display: block;
            margin-bottom: 15px;
        }
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 10px;
    }

    @media only screen and (min-width: 765px) {
        .dt-buttons.btn-group.flex-wrap {
            color: #14496C;
            margin-bottom: -50px;
        }
    }

    /* Custom css buat tabel ketitka resolusi dibawah 431*/
    @media only screen and (max-width: 431px) {
        .btn.btn-secondary.buttons-print {
            display: none;
        }

        .btn.btn-secondary.buttons-copy.buttons-html5 {
            display: none;
        }

        .btn.btn-secondary.buttons-excel.buttons-html5 {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        #judul-tabel-1 {
            text-align: center;
            margin-bottom: 20px;
        }

    }

    /* Custom css buat "berkas apa yg kamu cari?" ketitka resolusi diatas 768*/
    @media only screen and (min-width: 768px) {
        #button-card-search {
            justify-content: flex-end !important;
            align-items: flex-end !important;
        }
    }

    /* Custom css buat "berkas apa yg kamu cari?" ketitka resolusi dibawah 768*/
    @media only screen and (max-width: 768px) {
        #button-card-search {
            margin-top: 16px;
        }
    }

    .active {
        color: black;
    }

    @media only screen and (max-width: 768px) {
        #kanan {
            display: block !important;
        }

        #unit {
            margin-right: 0px !important;
            margin-left: 0px !important;
            margin-bottom: 8px;
            margin-top: 12px;
            display: block !important;
        }

        #kanan {
            display: block !important;
        }
    }
    </style>
</head>

<body>
    @yield('content')
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
    src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/af-2.6.0/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>