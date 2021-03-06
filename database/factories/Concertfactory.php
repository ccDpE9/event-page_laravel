<?php

use Faker\Generator as Faker;

$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords=3),
        'description' => $faker->sentence,
        'date' => $faker->dateTimeBetween("+1 days", "+3 years")->format("Y-m-d"),
        'start_time' => '20:00:00',
        'end_time' => '22:00:00',
        'city' => $faker->city,
        'venue' => $faker->company,
        'venue_address' => $faker->streetAddress,
        'ticket_price' => 55.00,
        'tickets_quantity' => 50,
    ];
});
