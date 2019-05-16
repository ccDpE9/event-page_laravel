<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords=3),
        'description' => $faker->sentence,
        'date' => '2019-01-01',
        'start_time' => '20:00:00',
        'end_time' => '22:00:00',
        'city' => $faker->city,
        'venue' => $faker->company,
        'venue_address' => $faker->streetAddress,
        'additional_information' => $faker->streetAddress,
        'ticket_price' => $faker->randomFloat(2, 1.00),
        'tickets_quantity' => 100,
        'tickets_left' => 100
    ];
});

/*
$factory
    ->state(App\Concert::class, "with_tickets", [])
    ->afterCreatingState(App\Concert::class, "with_tickets", function($user, $faker) {
        factory(App\Ticket::class, $concert->ticket_quantity)->create([
            "concert_id" => $concert->id,
        ]);
    });

$factory
    ->state(App\Concert::class, "with_tickets", [])
    ->afterMakingState(App\Concert::class, "with_tickets", function($user, $faker) {
        factory(App\Ticket::class, $concert->ticket_quantity)->make([
            "concert_id" => $concert->id,
        ]);
    });
*/

$factory->afterMaking(App\Concert::class, function($concert, $faker) {
    $ticket = factory(App\Ticket::class)->make([
        "concert_id" => $concert->id
    ]);
});


$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        "concert_id" => 1
    ];
});
