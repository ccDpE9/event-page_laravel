<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create([
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
        ]);

        $user = Role::create([
            "name" => "User",
            "slug" => "user",
            "permissions" => [
                "read-concert" => true,
                "read-ticket" => true,
                "create-order" => true,
            ]
        ]);

        $unverified = Role::create([
            "name" => "Unverified",
            "slug" => "unverified",
            "permissions" => [ null ]
        ]);
    }
}
