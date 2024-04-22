<?php

namespace App\Plugins\SalesOrder\Mail;

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
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($sales_order, $image, $date, $pdf)
    {
        $this->sales_order = $sales_order;
        $this->image = $image;
        $this->date = $date;
        $this->pdf = $pdf;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    { 
        $subject = "Order Confirmation: Your Recent Purchase (Order #[" . $this->sales_order->sales_order_id . "]) from Tag Concept";
        return $this->markdown('sales_order::admin.emails.new_order_mail')->subject($subject)->attachData($this->pdf->output(),"Receipt.pdf");
    }
}