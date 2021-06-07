<?php

namespace Svodya\Payzone\Listeners;

use App\Events\OrderShipped;
use App\Notifications\PurchaseOrderInitialized;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
