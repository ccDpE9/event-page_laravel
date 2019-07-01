<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ConcertControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }


    // --- CREATE

    /** @test */
    public function fillable_fields_can_be_stored()
    {
        // - Tests mass asignment and fillable property
        // - Basically tests whether the store() method works when everything is as expected
        $concert = factory("App\Concert")->make()->toArray();
        $concert["title"] = "Testing title";
        $this->call("POST", route("concerts.store"), $concert);
        $this->assertDatabaseHas("concerts", $concert);
    }

    /** @test */
    public function guarded_fields_can_be_stored() 
    {
    
    }

    /** @test */
    public function test_required_fields()
    {
        $concert = factory("App\Concert")->create([
            "title" => "",
        ]);

        $this-->assertSessionHasErrors([
            "title"
        ]);
    }

    /** @test */
    public function fields_are_stored_as_specified()
    {

        $concert = factory("App\Concert")->create();

        $mapFields = array(); 

        foreach($concert->toArray() as $field) {
            $arr[$field] = $concert->{$field};
        }

        $response->assertJsonFragment($mapFields);
    }

    /** @test */
    public function newly_created_concert_is_returned()
    {
        // assertJsonStructure
    }


    // --- READ

    /** @test */
    public function user_can_view_index_page()
    {
        $this->get(route("concerts.index"))
             ->assertStatus(200);
    }

    /** @test */
    public function user_can_view_concerts()
    {
        factory("App\Concert", 2)->create();

        $this->json("GET", "/api/concerts")
             ->assertStatus(200)
             ->assertJsonStructure([
                 "data" => [
                     [
                         "title",
                         "description", 
                         "date", 
                         "start_time", 
                         "end_time",
                         "city",
                         "venue",
                         "venue_address",
                         "ticket_price",
                         "tickets_quantity", 
                     ]
                 ],
             ]);
    }

    /** @test */
    public function old_concerts_are_not_displayed()
    {
        $concert = factory("App\Concert")->create(["date" => "2018-01-02"]);
        $this
            ->json("GET", "/api/concerts")
            ->assertJsonMissing($concert->toArray());
    }


    // --- UPDATE

    /** @test */
    public function fillable_fields_can_be_updated()
    {
    }

    /** @test */
    public function guarded_fields_cant_be_updated()
    {
    }

}
