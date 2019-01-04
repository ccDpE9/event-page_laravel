<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    'remember_token' => str_random(10),
  ];
});

$factory->define(App\Concert::class, function (Faker $faker) {
  return [
    'title' => $faker->sentence($nbWords=3),
    'description' => $faker->sentence,
    'ticket_price' => $faker->randomFloat(2, 1.00),
    'city' => $faker->city,
    'venue' => $faker->company,
    'venue_address' => $faker->streetAddress,
    'additional_information' => $faker->phoneNumber,
  ];
});
