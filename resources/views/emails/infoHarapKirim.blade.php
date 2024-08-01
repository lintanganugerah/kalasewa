<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-body {
            font-size: 16px;
            line-height: 1.6;
        }

        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888888;
        }

        .highlight {
            font-weight: bold;
        }

        .kalasewa-color {
            color: #EE1B2F;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2 class="kalasewa-color">Kalasewa</h2>
        </div>
        <div class="email-body">
            <p>Yth. {{ $namaPemilik }}</p>
            <p>
                Sistem kami mendeteksi bahwa produk/kostum anda <span class="highlight">{{ $namaProduk }}</span>
                dengan nomor order
                <span class="highlight">{{ $nomorOrder }}</span>
                memiliki tanggal mulai penyewaan
                pada <span class="highlight">{{ $tanggalMulai }}</span>
            </p>
            <p>
                <span class="highlight">Harap segera inputkan nomor resi kostum/produk tersebut MAKSIMAL HARI INI. Jika
                    belum dilakukan hingga tanggal
                    mulai penyewaan, maka pesanan tersebut otomatis terbatalkan oleh sistem.</span>
            </p>
            <p>
                Terima kasih atas perhatian dan kerjasamanya. Hormat kami, Tim Kalasewa
            </p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Kalasewa. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
