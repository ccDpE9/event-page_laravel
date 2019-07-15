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
            "password" => Hash::make("testpass")
        ]);
        $this->rootToken = $this->json("POST", route("login"), [
            "email" => $this->root["email"],
            "password" => "testpass"
        ]);
    }

    /** @test */
    public function non_root_user_cannot_create_new_user()
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "valid@email.com",
            "password" => "test"
        ]);

        $response->assertJson([
            "data" => "Unauthorized action."
        ]);
    }

    /** @test */
    public function root_can_create_new_user()
    {
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken->baseResponse->original["token"],
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "testusername",
                "email" => "valid@email.com",
                "password" => "testpassw",
            ])
            ->assertStatus(200);
        $this->assertDatabaseHas("users", $this->root->toArray());
    }

    /** @test */
    public function username_is_required_on_registration()
    {
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken->baseResponse->original["token"],
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "email" => "validtwo@email.com",
                "password" => "testingyz"
            ])
            ->assertJsonFragment([
                "name" => [ "The name field is required." ]
            ]);
    }

    /** @test */
    public function email_field_is_required_on_registration()
    {
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken->baseResponse->original["token"],
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "userone",
                "password" => "testingyz"
            ])
            ->assertJsonFragment([
                "email" => [ "The email field is required." ]
            ]);
    }

    /** @test */
    public function password_is_required_on_registration()
    {
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken->baseResponse->original["token"],
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
    }


    // --- LOGIN

    /** @test */
    public function login_requires_email_and_password()
    {
        $this->post(route("login"))
             ->assertStatus(302)
             ->assertJson([
                 "email" => ["The email field is required."],
                 "password" => ["The password field is required."]
             ]);
    }

    /** @test */
    public function successfull_login()
    {
        $user = factory("App\User")->create([
            "name" => "testusername",
            "email" => "valid@email.com",
            "password" => Hash::make("testingpassword")
        ]);

        $response = $this->json("POST", route("login"), [
            "email" => $user["email"],
            "password" => "testingpassword"
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey("token", $response->json());
    }


    // --- LOGOUT

    /** @test */
    public function user_is_logged_out_properly()
    {
        $user = create("App\User", ["email" => "test@example.com"]);
        $token = $user->generateToken();
        $headers = ["Authorization" => "Bearer $token"];

        $this
            ->json("GET", "/api/articles", [], $headers)
            ->assertStatus(200);
        $this
            ->json("POST", "/api/logout", [], $headers)
            ->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    /** @test */
    public function user_is_logged_out_without_null_token()
    {
        $user = create("App\User", ["email" => "test@example.com"]);
        $token = $user->generateToken();
        $headers = ["Authorization" => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this
            ->json("GET", "/api/articles", [], $headers)
            ->assertStatus(401);
    }

    /** @test */
    public function upcoming_near_concerts_notification()
    {
        // https://laravel.com/docs/5.8/mocking#mail-fake
    }

}
