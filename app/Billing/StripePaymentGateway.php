<?php

namespace App\Billing;

use App\Billing\PaymentGateway;
use Stripe\Charge;
//use Stripe\Error\InvalidRequest;
//use App\Billing\PaymentFailedException;

class StripePaymentGateway implements PaymentGateway
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function charge($amount, $token)
    {
        Charge::create([
            "amount" => $amount,
            "source" => $token,
            "currency" => "usd"
        ], ["api_key" => $this->apiKey]);
    }
}
