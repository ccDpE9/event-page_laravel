<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateConcertTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }


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
    public function store_returns_newly_created_concert()
    {
        $concert = factory("App\Concert")->make()->toArray();
        $this
            ->call("POST", route("concerts.store"), $concert)
            ->assertJsonStructure($this->responseJsonStructure);
    }

    /** @test */
    public function unauthenticated_user_cannot_create_a_concert()
    {
        // --- 1. Try to visit create_concert
        $this->get(route("concert.store"))
        // --- 2. Assert error is auth() middleware related
            ->assertRedirect(route("login")); 
    }

    /** @test */
    public function authenticated_unauthorized_user_cannot_create_a_concert()
    {
        $user = factory(User::class)->create([
            "admin" => false
        ]);

        $response = $this->actingAs($user)->post(route("concerts.store"), [
        ]);

        $response->assertStatus(403);
    }
}

