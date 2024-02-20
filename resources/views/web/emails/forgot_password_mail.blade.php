<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <p>Hello,</p>
    <p>You have requested to reset your password. Please click the following link to proceed:</p>
    <a href="{{ route('web.reset_password', ['token' => $randomString]) }}">Reset Password</a>
    <p>If you didn't request this, you can safely ignore this email.</p>
    <p>Thank you!</p>
</body>
</html>
