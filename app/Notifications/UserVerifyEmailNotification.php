<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use App\Mail\UserEmailVerificationMail;
class UserVerifyEmailNotification extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        return (new UserEmailVerificationMail($this->verificationUrl($notifiable)))
                    ->to($notifiable->email);
    }
}
