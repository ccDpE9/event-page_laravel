<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords=3),
        'description' => $faker->sentence,
        'start_time' => Carbon::parse('2019-12-01 8:00pm'),
        'end_time' => Carbon::parse('2019-12-01 10:00pm'),
        'city' => $faker->city,
        'venue' => $faker->company,
        'venue_address' => $faker->streetAddress,
        'additional_information' => $faker->streetAddress,
        'ticket_price' => $faker->randomFloat(2, 1.00),
        'ticket_quantity' => 100
    ];
});


// --- Concert Factory callback

$factory->afterCreating(App\Concert::class, function($concert, $faker {
    $concert->tickets()->save(factory(App\Ticket::class, $concert->ticket_quantity)->create());
});
