<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class ShippingFeeMail extends Mailable
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
            view: 'admin.emails.shipping_fee_mail',
        );
    }

    public function build()
    {       
        $subject = "Important Information About Your Order (Order #[".$this->sales_order->sales_order_id."]): Shipping Fee Update";
        return $this->markdown('admin.emails.shipping_fee_mail')->subject($subject);
    }
}