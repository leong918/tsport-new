<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($first_name, $last_name, $email, $message)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->message = $message;

        $this->from($email, $first_name);
    }

    /**
     * Get the message content definition.
     */

    public function build()
    {
        $subject = "Contact Us";

        return $this->markdown('web.mail')->subject($subject);
    }
}