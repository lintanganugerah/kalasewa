<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! Verifikasi Akun Kamu Gagal 🥺</title>
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

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #EE1B2F;
            margin: 20px 0;
            text-align: center;
        }

        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888888;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; color: #333; padding: 20px;">
    <div class="email-container"
        style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div class="email-header" style="text-align: center; margin-bottom: 20px;">
            <h2>Kalasewa</h2>
        </div>
        <div class="email-body">
            <p>Hey, <strong><?php echo e($user->nama); ?></strong>!</p>
            <p>Maaf ya, akun kamu belum berhasil diverifikasi karena <strong><?php echo e($reason); ?></strong></p>
            <p>Coba cek lagi deh informasi yang kamu berikan, daftar kembali dan ajukan ulang verifikasi akunmu. Kalau
                butuh bantuan, tim support kami siap bantu kok!</p>
            <p>Terima kasih atas pengertiannya ya.</p>
            <p style="font-size: 0.8em;">Cheers,<br>Tim Kalasewa</p>
        </div>
        <div class="email-footer" style="text-align: center; margin-top: 20px;">
            <p>&copy; <?php echo e(date('Y')); ?> Kalasewa. All rights reserved.</p>
        </div>
    </div>
</body>

</html><?php /**PATH /home/kalasewa/kalasewa/resources/views/emails/rejection.blade.php ENDPATH**/ ?>