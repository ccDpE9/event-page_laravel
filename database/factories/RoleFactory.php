<?php

use Faker\Generator as Faker;

// --- Role Factory
$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => null,
        'slug' => null,
    ];
});


// --- User's Factory states
$factory->state(Role::class, 'Admin', function() {
    return [
        "name" => "Admin",
        "slug" => "admin",
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
        "name" => "User",
        "slug" => "slug",
        "permissions" => [
            "read-concert" => true,
            "read-ticket" => true,
            "create-order" => true,
        ],
    ];
});

$factory->state(App\Role::class, 'Uneverified', function() {
    return [ 
        "name" => "Unverified",
        "slug" => "unverified",
        "permissions" => null 
    ];
});
