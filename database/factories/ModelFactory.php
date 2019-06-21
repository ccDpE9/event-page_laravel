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
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\User::class, "Admin", [
    "role_id" => function() {
        return App\Role::where("name", "Admin")->get()
    }
]);

$factory->define(App\User::class, "User", [
    "role_id" => function() {
        return App\Role::where("name", "User")->get()
    }
]);

$factory->define(App\User::class, "Unverified", [
    "role_id" => function() {
        return App\Role::where("name", "Uneverified")->get()
    }
]);

// --- Concert Factory
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


// --- Ticket Factory
$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        "order_id" => Null,
        "concert_id" => function() {
            return factory("App\Concert")->create()->id;
        },
    ];
});
