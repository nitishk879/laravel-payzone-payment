<?php

namespace Svodya\Payzone\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Svodya\Payzone\Models\Order;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    public $order;

    /**
     * Create a new message instance.
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Payzone::mail.orders.shipped');
    }
}
