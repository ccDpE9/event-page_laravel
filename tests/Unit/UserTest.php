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
    public function newly_created_user_is_admin_by_default()
    {
        $user = factory("App\User")->create();

        $this->assertFalse($user->isRoot());
        $this->assertEquals(
            $user->type,
            "admin"
        );
    }

    /** @test */
    public function is_root_returns_true_when_root()
    {
        $user = factory("App\User")->states("root")->create();

        $this->assertTrue($user->isRoot());
        $this->assertEquals(
            $user->type,
            "root"
        );
    }

}
