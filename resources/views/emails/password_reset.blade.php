<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Halo!</h2>
    <p>Berikut adalah password baru Anda:</p>

    <h3 style="color: #3490dc;">{{ $newPassword }}</h3>

    <p>Silakan login dengan password ini dan jangan lupa untuk menggantinya setelah login.</p>

    <br>

    <p>Terima kasih,</p>
    <p><strong>{{ config('app.name') }}</strong></p>
</body>
</html>
