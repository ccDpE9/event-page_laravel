<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


// --- Role Factory
$factory->define(App\Role::class, function (Faker $faker, $args) {
    return [
        'id' => null,
        'name' => null,
        'slug' => null,
    ];
});

// --- User's Factory states
$factory->state(App\Role::class, 'Admin', function() {
    return [
        "permissions" => [
            "create-concert" => true,
            "read-concert" => true,
            "update-concert" => true,
            "delete-concert" => true,
            "create-ticket" => true,
            "read-ticket" => true,
            "update-ticket" => true,
            "delete-ticket" => true,
            "create-order" => true,
            "read-order" => true,
            "update-order" => true,
            "delete-order" => true
        ]
    ];
});

$factory->state(App\Role::class, 'User', function() {
    return [
        "permissions" => [
            "read-concert" => true,
            "read-ticket" => true,
            "create-order" => true,
        ],
    ];
});

$factory->state(App\Role::class, 'Uneverified', function() {
    return [ "permissions" => null ];
});


// --- User Factory
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'role_id' => 3,
        'remember_token' => str_random(10),
    ];
});


// --- Concert Factory
$factory->define(App\Concert::class, function (Faker $faker) {
    $id = 1;
    return [
        'id' => $id++,
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

// --- Concert make() closure
$factory->afterMaking(App\Concert::class, function($concert, $faker) {
    $concert->tickets()->saveMany(factory(App\Ticket::class, $concert->tickets_quantity)->make([
        "concert_id" => $concert->id,
    ]));
});


// --- Ticket Factory
$factory->define(App\Ticket::class, function (Faker $faker, $id) {
    return [
        "concert_id" => $id["concert_id"],
    ];
});
