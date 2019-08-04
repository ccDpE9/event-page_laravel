<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteConcertTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->concert = factory("App\Concert")->create();
        
    }

    /** @test */
    public function guest_cannot_delete_concerts()
    {
        $response = $this->delete(route("concerts.destroy", $this->concert->id));
        $response
            ->assertStatus(401)
            ->assertJsonFragment(["status" => "You must be authenticated to perform this action."]);
        $this->assertDatabaseHas("concerts", [
            "title" => $this->concert->title
        ]);
    }

    /** @test */
    public function authenticated_root_user_can_delete_concerts()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->rootToken,
                "Accept" => "application/json",
            ])
            ->delete(route("concerts.destroy", $this->concert->id))
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully deleted."]);
    }

    /** @test */
    public function authenticated_admin_user_can_delete_concerts()
    {
        $this
            ->withHeaders([
                "Authorization" => "Bearer".$this->adminToken,
                "Accept" => "application/json",
            ])
            ->delete(route("concerts.destroy", $this->concert->id))
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully deleted."]);
    }


    // @TODO ? Unit test: Deleting Concert deletes all related ticktes
    // @TODO ? Unit test: Authorized user cannot delete concerts that has orders associated with it : Or: Authorized user can delete concerts and all orders associated with it, but orderers get their re-fund
}
