<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
        $this->withoutExceptionHandling();

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
        $user = factory("App\User")->states("root")->create();
        $this->actingAs($user);
        $newUser = [
            "name" => "test",
            "email" => "valid@email",
            "password" => "test"
        ];
        $response = $this->post(route("register"), $newUser);
        $this->assertContains(
            $response,
            $newUser
        );

    }

    /** @test */
    public function registration_requires_password_and_email()
    {
        $this
            ->json("POST", "api/register")
            ->assertJson([
                "name" => ["The name field is required."],
                "email" => ["The email field is required."],
                "password" => ["The password field is required."],
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
    public function email_and_password_are_require()
    {
        $this->json("POST", "api/login")
             ->assertStatus(200)
             ->assertJson([
                 "email" => ["The email field is required."],
                 "password" => ["The password field is required."]
             ]);
    }

    /** @test */
    public function successfull_login()
    {
        $user = create("App\User", [
            "email" => "test@example.com",
            "password" => bcrypt("password"),
        ]);

        $this
            ->json("POST", "api/login", [
                "email" => "test@example.com",
                "password" => bcrypt("password")
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [ "id", "name", "email", "api_token" ],
            ]);
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
