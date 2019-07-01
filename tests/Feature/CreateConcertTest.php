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
    

    /** @test */
    public function user_can_store_concert_and_get_it_as_response()
    {
        $concert = factory("App\Concert")->make()->toArray();
        
        $this
            ->call("POST", route("concerts.store"), $concert)
            ->assertStatus(200)
            ->assertJsonStructure($this->responseJsonStructure)
            ->assertJsonFragment($concert);
    }

    /** @test */
    public function trying_to_store_non_nullable_field_returns_an_error()
    {
        $concert = factory("App\Concert")->make()->toArray();

        foreach($concert as $field => $value) {
            $concert[$field] = null;
            $this
                ->call("POST", route("concerts.store"), $concert)
                ->assertSessionHasErrors([$field]);
        }

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

