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
        // 1. Unit tests should not hit the DB
        $concert = make("App\Concert", [ "id" => 1 ]);
        make("App\Ticket", [ "concert_id" => $concert->id ]);
        // 2. Concert has many tickets
        $this->assertInstanceOf(
            "Illuminate\Database\Eloquent\Collection",
            $concert->tickets
        );
        $this->assertInstanceOf(
            "App\Ticket",
            $concert->tickets()->first()
        );
    }

    /** @test */
    public function date_is_formatted()
    {
        return $this->assertEquals('January 1, 2019', $this->concert->date);
    }

    /** @test */
    public function start_time_is_formatted()
    {
        $this->assertEquals("20:00", $this->concert->start_time);
    }

    /** @test */
    public function end_time_is_formatted()
    {
        $this->assertEquals("22:00", $this->concert->end_time);
    }

    /** @test */
    public function unauthorized_users_cant_create_or_modify_concerts()
    {
    }

    /** @test */
    public function increasing_tickets_quantity_attribute_adds_equal_number_of_tickets()
    {
        // --- 1. Login as authorized user
    }

    /** @test */
    public function decreasing_tickets_quantity_attribute_removes_equal_number_of_tickets()
        // --- 1. Login as authorized user
    {
    }

    /** @test */
    public function tickets_price_attribute_can_be_updated()
    {
        // --- 1. Login as authorized user
    }

}

