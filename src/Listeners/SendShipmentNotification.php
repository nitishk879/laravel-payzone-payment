<?php

namespace Svodya\Payzone\Listeners;

use App\Notifications\PurchaseOrderInitialized;
use App\User;
use Illuminate\Support\Facades\Notification;
use Svodya\Payzone\Events\OrderShipped;

class SendShipmentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $user = User::find(1);

        $user->notify(new PurchaseOrderInitialized($event->order));
    }
}
