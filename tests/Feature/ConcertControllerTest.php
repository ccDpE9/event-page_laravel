<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ConcertControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    function user_can_view_concerts_list()
    {
        $this->withoutExceptionHandling();
        $concert = create('App\Concert');
        //$response = $this->get(route('concerts.index'));
        //$response->assertSee($concert->title);
        $concert->tickets->assertEqual($concert->ticket_quantity);
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
