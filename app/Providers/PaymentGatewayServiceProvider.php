<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Billing\PaymentGateway;
use App\Billing\StripePaymentGateway;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentGateway::class, StripePaymentGateway::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
