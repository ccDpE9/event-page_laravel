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
        
        // - Argument for assertJsonStructure()
        $this->responseJsonStructure = [
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
