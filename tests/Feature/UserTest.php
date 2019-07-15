<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->root = factory("App\User")->states("root")->create([
            "password" => Hash::make("rootpass")
        ]);

        $this->admin = factory("App\User")->create([
            "password" => Hash::make("adminpass"),
        ]);
    }

    protected function authenticate($user) {
        if ($user->isRoot()) {
            return $this->json("POST", route("login"), [
                "email" => $user->email,
                "password" => "rootpass"
            ])->baseResponse->original["token"];

        }
        return $this->json("POST", route("login"), [
            "email" => $user->email,
            "password" => "adminpass"
        ])->baseResponse->original["token"];
    }

    /** @test */
    public function unauth_user_cannot_create_new_user()
    {
        $this->withoutExceptionHandling();
        $this
            ->json("POST", route("register"), [
                "email" => "test@email.com",
                "name" => "test",
                "password" => "testpass",
                "password_confirm" => "testpass"
            ])
            ->assertForbidden();
    }

    /** @test */
    public function admin_user_cannot_create_new_user()
    {
        $token = $this->authenticate($this->admin);

        $this
            ->actingAs($this->admin, "api")
            ->withHeaders([
                "Authorization" => "Bearer".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "test",
                "email" => "valid@email.com",
                "password" => "test",
                "password_confirmation" => "test"
            ])
            ->assertJsonFragment([
                "data" => "Unauthorized action.",
            ]);
    }

    /** @test */
    public function root_can_create_new_user()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "testusername",
                "email" => "valid@email.com",
                "password" => "testpassw",
                "password_confirmation" => "testpassw",
            ])
            ->assertStatus(200);
        $this->assertDatabaseHas("users", $this->root->toArray());
    }

    /** @test */
    public function username_is_required_on_registration()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "email" => "validtwo@email.com",
                "password" => "testingyz",
                "password_confirmation" => "testingyz"
            ])
            ->assertJsonFragment([
                "name" => [ "The name field is required." ]
            ]);
    }

    /** @test */
    public function email_field_is_required_on_registration()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "userone",
                "password" => "testingyz",
                "password_confirmation" => "testingyz"
            ])
            ->assertJsonFragment([
                "email" => [ "The email field is required." ]
            ]);
    }

    /** @test */
    public function password_is_required_on_registration()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "userone",
                "email" => "justanemail@email.com",
            ])
            ->assertJsonFragment([
                "password" => [ "The password field is required." ]
            ]);
    }

    /** @test */
    public function registration_requires_password_confirmation()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "userone",
                "email" => "justanemail@email.com",
                "password" => "testypass",
            ])
            ->assertJsonFragment([
                "password" => [ "The password confirmation does not match." ],
            ]);
    }


    /** @test */
    public function success_message_is_returned_after_the_complete_registration()
    {
        $token = $this->authenticate($this->root);

        $this
            ->actingAs($this->root, "api")
             ->withHeaders([
                 "Authorization" => "Bearer ".$token,
                 "Accept" => "application/json",
             ])
             ->json("POST", route("register"), [
                 "name" => "newadmin",
                 "email" => "justanemail@email.com",
                 "password" => "onetwoayy",
                 "password_confirmation" => "onetwoayy",
             ])
             ->assertJsonFragment([
                 "message" => "User was created successfully."
             ]);
    }

    // --- LOGIN

    /** @test */
    public function email_field_is_required_on_login()
    {
        $this
            ->json("POST", route("login"), [
                "password" => "testpass"
            ])
            ->assertJsonFragment([
                "email" => ["The email field is required."],
            ]);
    }

    /** @test */
    public function password_field_is_required_on_login()
    {
        $this
            ->json("POST", route("login"), [
                "email" => $this->root->email,
            ])
            ->assertJsonFragment([
                "password" => ["The password field is required."],
            ]);
    }

    /** @test */
    public function successfull_login_returns_token()
    {
        $response = $this
            ->json("POST", route("login"), [
                "email" => $this->admin->email,
                "password" => "adminpass",
            ]);
        $this->assertArrayHasKey("token", $response->json());
    }


    // --- LOGOUT

    /** @test */
    public function user_is_logged_out_properly()
    {
        $token = $this->authenticate($this->admin);

        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
                "Accept" => "application/json",
            ])
            ->json("GET", route("logout"))
            ->assertJsonFragment([
                "message" => "User logged out successfully."
            ]);
    }

    // --- UPDATE

    /** @test */
    public function admin_can_update_its_details()
    {
    }


    // --- DELETE
    /** @test */
    public function admin_can_delete_its_profile()
    {
    }
}
