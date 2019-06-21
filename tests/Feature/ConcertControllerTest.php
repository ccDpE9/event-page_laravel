<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ConcertControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    // --- READ
    
    /** @test */
    public function user_can_view_index_page()
    {
        $this->get(route("concerts.index"))
            ->assertStatus(200);
    }

    /** @test */
    public function user_can_view_concerts()
    {
        $concertOne = create("App\Concert");
        $concertTwo = create("App\Concert");
        $response = $this->get(route("concerts.index"));
        $response->assertStatus(200);
        $response->assertSee($concertOne->name);
        $response->assertSee($concertTwo->name);
    }


    // --- CREATE
    
    /** @test */
    public function unverified_user_cannot_create_a_concert()
    {
        $user = create("App\User", $state = "Unverified");
    }

    /** @test */
    public function unauthorized_user_cannot_update_a_concert()
    {
    }

    /** @test */
    public function unauthorized_user_cannot_delete_a_concert()
    {
    }

    /** @test */
    public function authorized_user_can_create_a_concert()
    {
        $attributes = [
        ];

        $this->post("/concerts", $attributes);

        $this->assertDatabaseHas("concerts", $attributes);
    }

    /** @test */
    function correct_number_of_tickets_is_created_upon_concert_creation()
    {
        /* The reason why this is not Unit test is because it does not test a functionallity in isolation, but the interaction between two models */

        // 1. It should make as many Ticket objects as it's defined in $concert->ticket_quantity
        // 2. Ticket object should have $ticket->order_id = Null
        // 3. Ticket object should have $ticket->concert_id = $this->id
    }

}
