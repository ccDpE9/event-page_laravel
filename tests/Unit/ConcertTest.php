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

