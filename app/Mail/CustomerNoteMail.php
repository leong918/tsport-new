<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class CustomerNoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer_note;

    /**
     * Create a new message instance.
     */
    public function __construct($customer_note)
    {
        $this->customer_note = $customer_note;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'web.emails.customer_note_mail',
        );
    }

    public function build()
    {
        return $this->markdown('web.emails.customer_note_mail');
    }
}