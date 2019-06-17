<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    /** @test */
    public function an_order_must_have_a_user_associated_with_it()
    {
    }

    /** @test */
    public function an_order_must_have_a_tickets_associated_with_it()
    {
    }

    /** @test */
    public function an_order_can_determine_the_total_cost_of_all_its_products()
    {
        // $order->total
    }

    /** @test */
    public function a_user_cant_order_more_tickets_than_there_are_available()
    {
        // --- Why is this Unit tests?
        // --- Integration tests should be consisted of API tests - Controller tests.
    }
}
