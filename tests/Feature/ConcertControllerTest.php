<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ConcertControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    function user_can_view_concerts_list()
    {
        $this->withoutExceptionHandling();
        $concert = factory('App\Concert')->create();
        // @TODO: get(): returns HTTP\Response
        $response = $this->get(route('concerts.index'));
        $response->assertSee($concert->title);
    }
}
