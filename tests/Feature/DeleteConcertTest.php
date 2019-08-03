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
    }

    /** @test */
    public function guest_cannot_delete_concerts()
    {
        $this->withoutExceptionHandling();
        $concert = factory("App\Concert")->create();
        $response = $this->delete(route("concerts.destroy", $concert->id));
        $response
            ->assertStatus(401)
            ->assertJsonFragment(["status" => "You must be authenticated to perform this action."]);
        $this->assertDatabaseMissing("concerts", $concert->toArray());
    }

    /** @test */
    public function authorized_user_can_delete_concerts()
    {
        // @TODO: assert response contains: "data" => "Was succ deleted."
    }

    // @TODO ? Unit test: Deleting Concert deletes all related ticktes
    // @TODO ? Unit test: Authorized user cannot delete concerts that has orders associated with it : Or: Authorized user can delete concerts and all orders associated with it, but orderers get their re-fund
}
