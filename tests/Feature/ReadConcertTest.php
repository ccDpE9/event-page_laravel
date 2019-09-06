<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadConcertTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function user_can_view_concerts()
    {
        factory("App\Concert", 2)->create();

        $this->call("GET", route("concerts.index"))
             ->assertStatus(200)
             ->assertJsonCount(2, "data")
             ->assertJsonStructure(["data"]);
    }

    /** @test */
    public function old_concerts_are_not_displayed()
    {
        $concert = factory("App\Concert")->create(["date" => "2018-01-02"]);
        $this
            ->json("GET", "/api/concerts")
            ->assertJsonMissing($concert->toArray());
    }

    /** @test */
    public function index_controller_returns_fields_specified_by_a_resource()
    {
        $firstConcert = factory("App\Concert")->create();
        $secondConcert = factory("App\Concert")->create();

        $response = $this
            ->get(route("concerts.index"))
            ->assertStatus(200)
            ->assertJsonFragment([
                "slug" => $firstConcert->slug,
                "date" => $firstConcert->date,
                "city" => $firstConcert->city,
                "avenue" => $firstConcert->venue,
                "tickets_price" => (string)$firstConcert->ticket_price,
                "tickets_left" => $firstConcert->tickets()->available(),
            ])
            ->assertJsonFragment([
                "slug" => $secondConcert->slug,
                "date" => $secondConcert->date,
                "city" => $secondConcert->city,
                "avenue" => $secondConcert->venue,
                "tickets_price" => (string)$secondConcert->ticket_price,
                "tickets_left" => $secondConcert->tickets()->available(),
            ]);
    }
}
