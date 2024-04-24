<?php

namespace App\Plugins\SalesOrder\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class OrderReceivedMail extends Mailable
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

    public function build()
    {
        $subject = "Order Received: Your Recent Purchase (Order #[" . $this->sales_order->sales_order_id . "]) from Tag Concept";
        return $this->markdown('sales_order::admin.emails.order_received_mail')->subject($subject);
    }
}