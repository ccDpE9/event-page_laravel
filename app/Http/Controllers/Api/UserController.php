<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function create(RegisterAuthRequest $request)
    {
        User::create([
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "password" => bcrypt($request->password),
            "type" => User::ADMIN_USER_TYPE,
        ]);

        return response()->json([
            "message" => "User was created successfully."
        ], 200);
    }

    public function update(Request $request)
    {
        // You don't want to protect this route with IsRoot middleware
        
        //$this->authorize("can:update-user");
        $user = User::findOrFail($request->email);
        $user->update($request->all());

        return response()->json([
            "message" => "User was updated successfully."
        ]);
    }

    public function destroy(Request $request)
    {
    }
}
