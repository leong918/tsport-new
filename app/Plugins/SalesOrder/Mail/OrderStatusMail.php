<?php

namespace App\Plugins\SalesOrder\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales_order;
    public $image;
    public $date;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct($sales_order, $image, $date, $status)
    {
        $this->sales_order = $sales_order;
        $this->image = $image;
        $this->date = $date;
        $this->status = $status;
    }

    /**
     * Get the message content definition.
     */

    public function build()
    {
        $subject = "Order Update (Order #[".$this->sales_order->sales_order_id."]):Order Status Has Been Updated";

        return $this->markdown('sales_order::admin.emails.order_status_mail')->subject($subject);
    }
}