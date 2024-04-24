<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class SubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $email_content;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $email_content)
    {
        $this->user = $user;
        $this->email_content = $email_content;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.customer_note_mail',
        );
    }

    public function build()
    {
        return $this->markdown('admin.emails.subscriber_mail')->subject($this->email_content->subject);
    }
}