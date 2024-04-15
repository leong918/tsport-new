<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales_order;
    public $image;
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct($sales_order, $image, $date)
    {
        $this->sales_order = $sales_order;
        $this->image = $image;
        $this->date = $date;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.new_order_mail',
        );
    }

    public function build()
    {
        $subject = "Order Confirmation: Your Recent Purchase (Order #[" . $this->sales_order->sales_order_id . "]) from Tag Concept";
        return $this->markdown('admin.emails.new_order_mail')->subject($subject);
    }
}