<?php

namespace Svodya\Payzone\Listeners;

use App\Events\PurchasePayment;
use App\Notifications\PaymentInvoice;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPurchaseInvoice
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
     * @param  PurchasePayment  $event
     * @return void
     */
    public function handle(PurchasePayment $event)
    {
        $user = User::find(1);

        $user->notify(new PaymentInvoice($event->customer));
    }
}
