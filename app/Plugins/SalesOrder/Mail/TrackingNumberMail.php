<?php

namespace App\Plugins\SalesOrder\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
class TrackingNumberMail extends Mailable
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
        $subject = "Order Update (Order #[".$this->sales_order->sales_order_id."]):Tracking Details for Your Recent Purchase";

        return $this->markdown('sales_order::admin.emails.tracking_number_mail')->subject($subject);
    }
}