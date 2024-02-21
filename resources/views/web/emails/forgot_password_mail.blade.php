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
    <b>Please take note that password reset link will be expired in 15 minutes.</b>
    <p>Thank you!</p>
    <p>Tag Concept Team</p>
</body>
</html>
