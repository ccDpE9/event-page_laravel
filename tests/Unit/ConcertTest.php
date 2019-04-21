<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Carbon\Carbon;

class ConcertTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->concert = create('App\Concert');
    }

    /** @test */
    function date_is_formatted()
    {
        $this->assertEquals('December 1, 2019', $this->concert->concertDate);
    }

    /** @test */
    function start_time_is_formatted()
    {
        $this->assertEquals('8:00pm', $this->concert->startTime);
    }

    /** @test */
    function ticket_price_is_in_euros()
    {
        $this->assertEquals('33.90', $this->concert->ticket_price_in_euros);
    }

    /** @test */
    function can_add_tickets()
    {
        // I could use factories to make tickets, with concert_id
        // Having a method on Concert model, that generates tickets, is better approach, because it'll be used to create actual tickets in controllers
        $concert = create('App\Concert');

        // $concert->generateTickets(10);

        // assert there is 50 tickets in the DB
    }
}

