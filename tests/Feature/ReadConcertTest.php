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
}
