<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{

    protected $ticket;

    public function setUp(): void
    {
    }

    /** @test */
    public function a_ticket_belongs_to_a_concert()
    {
    }

    /** @test */
    public function a_ticket_must_have_a_price_equal_to_one_specified_in_concert_column()
    {
    }

}
