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
    public function unauthenticated_user_cannot_create_a_concert()
    {
        // --- 1. Try to visit create_concert
        $this->get(route("concert.store"))
        // --- 2. Assert error is auth() middleware related
            ->assertRedirect(route("login")); 
    }
}

