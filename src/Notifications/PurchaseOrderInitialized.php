<?php

namespace Svodya\Payzone\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Svodya\Payzone\Models\Order;

class PurchaseOrderInitialized extends Notification
{
    use Queueable;

    /**
     * @var Order
     */
    public $order;

    /**
     * Create a new notification instance.
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/orders/'.$this->order->id);
        return (new MailMessage)
            ->greeting('Hello! ' . $this->order->customer->name)
            ->subject('Purchase Order has been generated')
            ->line('An Order has been initialised')
            ->line('Order Id: ' . $this->order->id)
            ->line('Order Amount: ' . $this->order->amount)
            ->line('Order Product(s): ' . $this->order->product_detail)
            ->action('Notification Action', $url)
            ->line('Thank you the !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
