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
        //@TODO $concert = factory("App\Concert")->create();
    }

    /** @test */
    public function guest_cannot_delete_concerts()
    {
        $concert = factory("App\Concert")->create();
        $response = $this->delete(route("concerts.destroy", $concert->id));
        $response
            ->assertStatus(401)
            ->assertJsonFragment(["status" => "You must be authenticated to perform this action."]);
        $this->assertDatabaseHas("concerts", [
            "title" => $concert->title
        ]);
    }

    /** @test */
    public function authenticated_root_user_can_delete_concerts()
    {
        $user = factory("App\User")->states("root")->create();

        $token = $this->json("POST", route("login"), [
            "email" => $user->email,
            "password" => "rootpass"
        ])->baseResponse->original["token"];

        $concert = factory("App\Concert")->create();

        $this
            ->withHeaders([
                "Authorization" => "Bearer".$token,
                "Accept" => "application/json",
            ])
            ->delete(route("concerts.destroy", $concert->id))
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully deleted."]);
    }

    /** @test */
    public function authenticated_admin_user_can_delete_concerts()
    {
        $user = factory("App\User")->create();

        $token = $this->json("POST", route("login"), [
            "email" => $user->email,
            "password" => "adminpass"
        ])->baseResponse->original["token"];

        $concert = factory("App\Concert")->create();

        $this
            ->withHeaders([
                "Authorization" => "Bearer".$token,
                "Accept" => "application/json",
            ])
            ->delete(route("concerts.destroy", $concert->id))
            ->assertStatus(200)
            ->assertJsonFragment(["status" => "Concert was successfully deleted."]);
    }


    // @TODO ? Unit test: Deleting Concert deletes all related ticktes
    // @TODO ? Unit test: Authorized user cannot delete concerts that has orders associated with it : Or: Authorized user can delete concerts and all orders associated with it, but orderers get their re-fund
}
