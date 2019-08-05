<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateConcertTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->concert = factory("App\Concert")->create();

    }

    /** @test */
    public function unauthenticated_users_cannot_update_concerts()
    {
        $this
            ->put(route("concerts.update", $this->concert->id), [
                "title" => "Just some new title"
            ])
            ->assertStatus(401)
            ->assertJsonFragment(["status" => "You must be authenticated to perform this action."]);
        $dbRes = $this->assertDatabaseHas("concerts", [
                "title" => $this->concert->title
            ]);
    }

    /** @test */
    public function authenticated_admin_user_can_update_concerts()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->adminToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "title" => "The end of the fucking world party."
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "title" => "The end of the fucking world party."
        ]);
    }


    /** @test */
    public function authenticated_root_user_can_update_concerts()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "title" => "The end of the fucking world party."
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "title" => "The end of the fucking world party."
        ]);
    }


    // - Testing whether filleable fields can be updated, on by one, of cource
    // @TODO: Isn't this unit testing, maybe?
    
    /** @test */
    public function title_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "title" => "The end of the fucking world party."
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "title" => "The end of the fucking world party."
        ]);
    }

    /** @test */
    public function city_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "city" => "New York"
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "city" => "New York"
        ]);
    }

    /** @test */
    public function venue_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "venue" => "Trap House",
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "venue" => "Trap House",
        ]);
    }

    /** @test */
    public function venue_address_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "venue_address" => "Adress 99",
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "venue_address" => "Adress 99"
        ]);
    }

    /** @test */
    public function ticket_price_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "ticket_price" => "99.99"
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "ticket_price" => "99.99"
        ]);
    }

    /** @test */
    public function tickets_quantity_field_can_be_updated()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->put(route("concerts.update", $this->concert->id), [
                "tickets_quantity" => "100"
            ])
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully updated."]);
        $this->assertDatabaseHas("concerts", [
            "tickets_quantity" => "100"
        ]);
    }
}
