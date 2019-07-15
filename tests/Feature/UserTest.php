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
        /*
        $this->rootToken = $this->json("POST", route("login"), [
            "email" => $this->root["email"],
            "password" => "testpass"
        ])->baseResponse->original["token"];
         */

        $this->admin = factory("App\User")->create([
            "password" => Hash::make("adminpass"),
        ]);
    }

    /** @test */
    public function non_root_user_cannot_create_new_user()
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "valid@email.com",
            "password" => "test",
            "password_confirmation" => "test"
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
                "Authorization" => "Bearer ".$this->rootToken,
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
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken,
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
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken,
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
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken,
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
        $this
            ->actingAs($this->root, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$this->rootToken,
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
        $this->withoutExceptionHandling();
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
