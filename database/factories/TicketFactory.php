<?php

use Faker\Generator as Faker;

// --- Ticket Factory
$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        "order_id" => Null,
        "concert_id" => function() {
            return factory("App\Concert")->create()->id;
        },
    ];
});
