<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    // --- REGISTER

    /** @test */
    public function user_can_register()
    {
        $this->post(route("user.store", [
        ]);
        $this->assertDatabaseHas("users", [
            email => "testing email"
        ]);
    }

    /** @test */
    public function newly_created_users_are_unverified()
    {
    }
    
    // --- LOGIN

    /** @test */
    public function user_can_log_in()
    {
        $user = factory(User::class)->create([
            "password" => Hash::make("password")
        ]);
        $this->post("login", [
            "email" => user.email,
            "password" => "password"
        ]);
        $this->assertTrue(auth()->check());
        $this->assertTrue($user->is(auth()->user()));
    }

    // --- DELETE

    /** @test */
    public function user_cannot_delete_other_peoples_profiles()
    {
    }

    /** @test */
    public function authorized_user_can_delete_his_hers_profile()
    {
    }
}
