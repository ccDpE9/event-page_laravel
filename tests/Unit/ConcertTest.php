<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\Event;
use Carbon\Carbon;

class ConcertTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function concert_has_many_tickets()
    {
        $concert = factory("App\Concert")->create();
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
        $concert = factory("App\Concert")->create(["date" => "2019-01-01"]);
        return $this->assertEquals('January 1, 2019', $concert->date);
    }

    /** @test */
    public function start_time_is_formatted()
    {
        $concert = factory("App\Concert")->create(["start_time" => "20:00"]);
        $this->assertEquals("20:00", $concert->start_time);
    }

    /** @test */
    public function end_time_is_formatted()
    {
        $concert = factory("App\Concert")->create(["end_time" => "22:00"]);
        $this->assertEquals("22:00", $concert->end_time);
    }

    /** @test */
    public function upcoming_scope_returns_future_concerts()
    {
        factory("App\Concert", 2)->create();
        $formerConcert = factory("App\Concert")->create([
            "date" => Carbon::parse("2019-05-01")
        ]);

        $result = \App\Concert::upcoming()->get();

        $this->assertTrue(
            !$result->contains($formerConcert)
        );
    }

    /** @test */
    public function created_event_fires_up_when_new_concert_is_created()
    {
        Event::fake("eloquent.created: ". \App\Concert::class);
        $concert = factory("App\Concert")->create();
        Event::assertDispatched("eloquent.created: ". \App\Concert::class);
    }

    /** @test */
    public function eloquent_event_creates_appropriate_number_of_tickets()
    {
        $concert = factory("App\Concert")->create();
        $this->assertEquals(
            $concert->tickets()->count(),
            $concert->tickets_quantity
        );
    }

    /** @test */
    public function updated_event_creates_appropriate_number_of_tickets_only_if_tickets_quantity_field_is_updated()
    {
        // @TODO: Create update observer
    }

    /** @test */
    public function updated_event_removes_appropriate_number_of_tickets_only_if_tickets_quantity_field_is_updated()
    {
        // @TODO: Create update observer
    }

    /** @test */
    public function tickets_left_returns_not_yet_ordered_tickets()
    {
        $concert = factory("App\Concert")->create();
        $this->assertEquals(
            $concert->ticketsLeft(),
            $concert->tickets_quantity
        );
    }
}
