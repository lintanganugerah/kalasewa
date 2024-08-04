<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>{{ config('app.name') }}</h1>
    <p>Hai!</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="center">
                            <a href="{{ $actionUrl }}" class="button" target="_blank">Reset Password</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p>This password reset link will expire in
        {{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') }} minutes.</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>{{ config('app.name') }}</p>
    <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web
        browser: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a></p>
    <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</body>

</html>