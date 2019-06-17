<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{

    // --- Concerts
    
    /** @test */
    public function unauthorized_user_cannot_create_concerts()
    {
    }

    /** @test */
    public function unauthorized_user_cannot_update_concerts()
    {
    }

    /** @test */
    public function unauthorized_user_cannot_delete_concerts()
    {
    }

    
    // --- Tickets

    /** @test */
    public function unauthorized_user_cannot_create_tickets()
    {
    }

    /** @test */
    public function unauthorized_user_cannot_update_tickets()
    {
    }

    /** @test */
    public function unauthorized_user_cannot_delete_tickets()
    {
    }

    /** @test */
    public function unverified_user_cannot_order_tickets()
    {
        /* User must verify their email */
    }

    /** @test */
    public function verified_user_can_order_tickets()
    {
        /* User must verify their email */
    }

    /** @test */
    public function non_registered_user_cannot_order_tickets()
    {
    }

    /** @test */
    public function registered_user_can_order_ticket()
    {
        $user = create("App\User");
        $this->be($user);
    }

}
