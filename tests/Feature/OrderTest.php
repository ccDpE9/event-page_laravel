<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    public function setUp(): void
    {
    }


    /** @test */
    public function a_user_can_order_a_ticket()
    {
    }

    /** @test */
    public function a_user_can_order_more_than_one_ticket()
    {
        $concert = create("App\Concert");
        $user = create("App\User");
        $order = create("App\Order", [
            "user_id" => $user->id,
            "concert_id" => $concert->id,
            "ticket_id" => $concert->tickets()->first(),
            "ticket_quantity" => 2,
        ]);
        // --- Should assert that $order->tickets is Collection of Ticket objects
    }

}
