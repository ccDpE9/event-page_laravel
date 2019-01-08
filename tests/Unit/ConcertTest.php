<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Carbon\Carbon;

class ConcertTest extends TestCase
{

    // use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->concert = make('App\Concert', [
            'date' => Carbon::parse('2019-12-01 8:00pm'),
            'ticket_price' => 3390
        ]);
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
}
