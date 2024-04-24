<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowStockMail extends Mailable
{
    use Queueable, SerializesModels;

    public $low_stock_product_list;
    public $low_stock_product_attribute_term_list;
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct($low_stock_product_list,$low_stock_product_attribute_term_list, $date)
    {
        $this->low_stock_product_list = $low_stock_product_list;
        $this->low_stock_product_attribute_term_list = $low_stock_product_attribute_term_list;
        $this->date = $date;
    }

    /**
     * Get the message content definition.
     */

    public function build()
    {
        $subject = "Low Stock Notification";

        return $this->markdown('web.emails.low_stock_mail')->subject($subject);
    }
}