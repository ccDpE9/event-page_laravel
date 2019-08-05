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
        $this
            ->withHeaders($this->rootToken)
            ->put(route("concercts.update", $this->concert->id), [
                "title" => "Just some new title"
            ]);
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
}
