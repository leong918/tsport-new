<?php

namespace App\Plugins\SalesOrder\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class AdminOrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales_order;
    public $date;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct($sales_order, $date, $status)
    {
        $this->sales_order = $sales_order;
        $this->date = $date;
        $this->status = $status;
    }

    /**
     * Get the message content definition.
     */

    public function build()
    {
        $subject = "Order Update (Order #[".$this->sales_order->sales_order_id."]):Order Status Has Been Updated";

        return $this->markdown('sales_order::admin.emails.admin_order_status_mail')->subject($subject);
    }
}