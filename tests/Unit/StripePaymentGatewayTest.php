<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Billing\StripePaymentGateway;

class StripePaymentGatewayTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->paymentGateway = new StripePaymentGateway(config("services.stripe.secret"));
        \Stripe\Stripe::setApiKey(config("services.stripe.secret"));
        $this->token = \Stripe\Token::create([
            "card" => [
                "number" => "4242424242424242",
                "exp_month" => 1,
                "exp_year" => date("Y") + 1,
                "cvc" => "123",
            ],
            //["api_key" => config("services.stripe.secret")]
        ])->id;
    }

    /** @test */
    public function charge_function_is_a_wrapper_around_stripes_charge_method()
    {
        $this->paymentGateway->charge(50, $this->token);
        $lastCharge = \Stripe\Charge::all(
            ["limit" => 1],
        )["data"][0];

        $this->assertEquals(50, $lastCharge->amount);
    }

    /** @test */
    public function charges_with_an_invalid_token_fial()
    {
        /*
        try {
            $this->paymentGateway->charge(10, "invalidtoken");
        } catch (PaymentFailedException $e) {
            $lastCharge = Charge::all(
                ["limit" => 1],
                ["api_key" => config("services.stripe.secret")]
            )["data"][0];
            $this->assert(0, $lastCharge);
            return;
        }

        $this->fail("No such token: invalid-payment-token");
         */
    }

}
