<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{

    /** @test */
    public function user_can_order_a_ticket()
    {
        $user = create("App\User");
        $this->be($user);
    }

    /** @test */
    public function user_can_order_more_than_one_ticket()
    {
    }

}
