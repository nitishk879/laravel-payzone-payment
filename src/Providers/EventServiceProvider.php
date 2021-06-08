<?php


namespace Svodya\Payzone\Providers;

use Svodya\Payzone\Events\OrderShipped;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Svodya\Payzone\Listeners\SendShipmentNotification;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderShipped::class =>[
            SendShipmentNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

}
