<?php

use Faker\Generator as Faker;

// --- User Factory
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->state(App\User::class, "Admin", function (Faker $faker) { 
    return [
        "role_id" => function() {
            return factory(App\Role::class, "Admin")->create()->id;
        },
    ];
});

$factory->state(App\User::class, "User", function (Faker $faker) {
    return [
        "role_id" => function() {
            return factory(App\Role::class, "Unverified")->create()->id;
        },
    ];
});

$factory->state(App\User::class, "Unverified", function (Faker $faker) {
    return [
        "role_id" => function() {
            return factory(App\Role::class, "Unverified")->create()->id;
        },
    ];
});
