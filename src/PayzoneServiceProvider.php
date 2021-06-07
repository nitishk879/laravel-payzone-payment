<?php

namespace Svodya\Payzone;

use Illuminate\Support\ServiceProvider;

class PayzoneServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'Payzone');

        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateCustomersTable') || (!class_exists('CreateOrdersTable'))) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_customer_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_customers_table.php'),
                    __DIR__ . '/../database/migrations/create_order_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_orders_table.php'),
                ], 'migrations');
            }
            $this->publishes([
                __DIR__.'/config/payzone.php' => config_path('payzone.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/style.css' => public_path('vendor/payzone/style.css'),
                __DIR__.'/loading.svg' => public_path('vendor/payzone/loading.svg'),
                __DIR__.'/cacert.pem' => public_path('vendor/payzone/cacert.pem'),
            ], 'public');

        }

        $this->loadViewsFrom(__DIR__.'/views', 'Payzone');

    }
}
