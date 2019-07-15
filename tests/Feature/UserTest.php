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
        $user = factory("App\User")->states("root")->create([
            "password" => Hash::make("testpass")
        ]);

        $token = $this->json("POST", route("login"), [
            "email" => $user["email"],
            "password" => "testpass"
        ]);

        $this
            ->actingAs($user, "api")
            ->withHeaders([
                "Authorization" => "Bearer ".$token->baseResponse->original["token"],
                "Accept" => "application/json",
            ])
            ->json("POST", route("register"), [
                "name" => "testusername",
                "email" => "valid@email.com",
                "password" => "testpassw",
            ])
            ->assertStatus(200);
        $this->assertDatabaseHas("users", $user->toArray());
    }

    /** @test */
    public function registration_requires_password_and_email()
    {
        $user = factory("App\User")->states("root")->create();
        $this->actingAs($user);
        $this
            ->post(route("register"), [
                "email" => "valid@email.com",
                "password" => "test"
            ])
            ->assertJson([
                "name" => ["The name field is required."],
            ]);
    }

    /** @test */
    public function registration_requires_password_confirmation()
    {
        $this
            ->json("POST", "api/register", [
                "name" => "Test",
                "email" => "test@example.com",
                "password" => "password",
            ])
            ->assertStatus(422)
            ->assertJson([
                "password" => ["The password confirmation does not match"]
            ]);
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
