<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $randomString;

    /**
     * Create a new message instance.
     */
    public function __construct($randomString)
    {
        $this->randomString = $randomString;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'web.emails.forgot_password_mail',
        );
    }

    public function build()
    {
        return $this->markdown('web.emails.forgot_password_mail');
    }
}