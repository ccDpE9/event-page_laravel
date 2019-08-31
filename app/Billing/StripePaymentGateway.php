<?php

namespace App\Billing;

use App\Billing\PaymentGateway;
use App\Billing\PaymentFailedException;

use Stripe\Charge;
use Stripe\Token;
use Stripe\Error\InvalidRequest;

class StripePaymentGateway implements PaymentGateway
{
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(config("services.stripe.secret"));
    }

    public function charge($amount, $token)
    {
        try {
            Charge::create([
                "amount" => $amount,
                "source" => $token,
                "currency" => "usd"
            ]);
            //], ["api_key" => $this->apiKey]);
        } catch (InvalidRequest $e) {
            throw new PaymentFailedException;
        }
    }

    public function testToken()
    {
        return Token::create([
            "card" => [
                "number" => "4242424242424242",
                "exp_month" => 1,
                "exp_year" => date("Y") + 1,
                "cvc" => "123",
            ],
            //["api_key" => config("services.stripe.secret")]
        ])->id;
    }
}
