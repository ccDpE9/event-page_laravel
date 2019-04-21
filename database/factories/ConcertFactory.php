<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords=3),
        'description' => $faker->sentence,
        'date' => Carbon::parse('2019-12-01'),
        'start_time' => '20:00:00',
        'end_time' => '22:00:00',
        'city' => $faker->city,
        'venue' => $faker->company,
        'venue_address' => $faker->streetAddress,
        'additional_information' => $faker->streetAddress,
        'ticket_price' => $faker->randomFloat(2, 1.00),
        'ticket_quantity' => 100
    ];
});


// --- Concert Factory callback

$factory->afterCreating(App\Concert::class, function($concert, $faker) {
    $concert->tickets()->save(factory(App\Ticket::class)->make());
});


$factory->define(App\Ticket::class, function ($concert_id) {
    return [
       'concert_id' => $concert_id
    ];
});
