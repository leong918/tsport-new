
<x-mail::message>
# Reset Password
Hello,<br>
You have requested to reset your password. Please click the following link to proceed:

<x-mail::button :url="route('web.reset_password', ['token' => $randomString])">
Reset Password
</x-mail::button>
If you didn't request this, you can safely ignore this email.<br>
Please take note that password reset link will be expired in 15 minutes.<br><br>
Thanks,<br>
Tag Concept Team
</x-mail::message>
