<?php

use Faker\Generator as Faker;

// --- User Factory
$factory->define(App\User::class, function (Faker $faker) {
    return [
        "name" => $faker->userName,
        "email" => $faker->unique()->safeEmail,
        //"is_admin" => True,
        "password" => "$2y$10PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm", // secret
        "type" => "admin",
        "remember_token" => str_random(10),
    ];
});

$factory->state(App\User::class, "root", [
    "type" => "root",
]);
