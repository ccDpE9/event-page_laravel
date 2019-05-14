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

    /** @test */
    public function a_concert_has_many_tickets()
    {
        // 1. *Make* tickets - unit tests should not hit the DB
        /*
        $concert = make("App\Concert", [
        ]);
        make("App\Ticket", [
            "concert_id" => %this->concert->id
        ]);
        $this->assertInstanceOf(
            "App\Ticket",
            $this->concert->tickets()
        );
         */
        $concert = make("App\Concert");
        dd($concert);
    }

    /** @test */
    function date_is_formatted()
    {
        return $this->assertEquals('January 1, 2019', $this->concert->date);
    }

    /** @test */
    function start_time_is_formatted()
    {
        $this->assertEquals("20:00", $this->concert->start_time);
    }

    /** @test */
    function end_time_is_formatted()
    {
        $this->assertEquals("22:00", $this->concert->end_time);
    }

}

