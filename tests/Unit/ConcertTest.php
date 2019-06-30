<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\Event;
use App\Observers\ConcertObserver;

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
    public function upcoming_scope_returns_future_ordered_concerts()
    {
        // --- Create concerts
        $upcomingConcertOne = create("App\Concert", [
            "date" => Carbon::parse("2019-06-26")
        ]);
        $upcomingConcertTwo = create("App\Concert", [
            "date" => Carbon::parse("2019-06-27")
        ]);
        $formerConcert = create("App\Concert", [
            "date" => Carbon::parse("2019-05-01")
        ]);

        // --- Call the local scope method
        $result = \App\Concert::upcoming()->get();

        // --- Assert that only upcoming concerts are returned
        $this->assertTrue(
            !$result->contains($formerConcert)
        );

        // --- Assert that upcoming concerts are propertly ordered
        $this->assertEquals(
            $upcomingConcertOne->title,
            $result->first()->title
        );
    }

    /** @test */
    public function saved_event_creates_appropriate_number_of_tickets()
    {
        Event::fake("eloquent.saved: ". \App\Concert::class);
        $concert = create("App\Concert");
        Event::assertDispatched("eloquent.saved: ". \App\Concert::class);
    }

    /** @test */
    public function eloquent_event_creates_appropriate_number_of_tickets()
    {
        $concert = create("App\Concert");
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
}

