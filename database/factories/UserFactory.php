<?php

use Faker\Generator as Faker;

// --- User Factory
$factory->define(App\User::class, function (Faker $faker) {
    return [
        "name" => $faker->userName,
        "email" => $faker->unique()->safeEmail,
        //"is_admin" => True,
        "password" => "$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm", // secret
        "remember_token" => str_random(10),
    ];
});
