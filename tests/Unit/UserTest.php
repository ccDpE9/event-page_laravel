<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function a_user_must_be_associated_with_a_role()
    {
        $user = create("App\User");
        $this->assertInstanceOf("App\Role", $user->role);
    }

    /** @test */
    public function a_user_can_be_associated_with_a_single_role()
    {
        // --- 1. Create a user with two specified roles
        // --- 2. Assert response contains appropriate message
    }

    /** @test */
    public function a_newly_created_user_is_unverified()
    {
        // --- 1. Create a user
        // --- 2. Assert his role is specified as "unverified" by default
    }

    /** @test */
    public function can_check_if_a_user_has_access_to_permissions()
    {
        // --- Tests hasAccess() method
    }

    /** @test */
    public function can_check_if_a_user_belongs_to_a_role()
    {
        // --- Tests inRole() method
    }

}
