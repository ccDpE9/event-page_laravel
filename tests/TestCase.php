<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        // $this->artisan('db:seed --class=RoleTableSeeder');
        
        // - Set up the root and an admin user to be used accross multiple Unit/Integration tests
        $this->root = factory("App\User")->states("root")->create();
        $this->rootToken = $this
            ->json("POST", route("login"), [
                "email" => $this->root->email,
                "password" => "rootpass"
            ])
            ->baseResponse
            ->original["token"];

        $this->admin = factory("App\User")->create();
        $this->adminToken = $this
            ->json("POST", route("login"), [
                "email" => $this->admin->email,
                "password" => "adminpass"
            ])
            ->baseResponse
            ->original["token"];

        // - Argument for assertJsonStructure()
        $this->responseConcertJsonStructure = [
            "data" => [
                "title",
                "description", 
                "date", 
                "start_time", 
                "end_time",
                "city",
                "venue",
                "venue_address",
                "ticket_price",
                "tickets_quantity", 
            ]
        ];
    }

    protected function signIn($user=null)
    {
        $user = $user ?: create ('App\User');
        $this->actingAs($user);
        return $this;
    }

}
