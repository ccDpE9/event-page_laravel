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
    public function fillable_fields_can_be_updated()
    {
    }

    /** @test */
    public function guarded_fields_cant_be_updated()
    {
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
}
