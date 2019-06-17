<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function a_role_has_users()
    {
        $role = create("App\Role");
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $role->users);
    }
}
