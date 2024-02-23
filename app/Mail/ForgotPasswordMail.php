<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $randomString;

    public function __construct($randomString)
    {
        $this->randomString = $randomString;
    }

    public function build()
    {
        return $this->view('web.emails.forgot_password_mail')
                    ->with([
                        'randomString' => $this->randomString,
                    ]);
    }
}
