<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $creds = $request->only("email", "password");

        try {
            if (!$token = JWTAuth::attempt($creds)) {
                return response()->json(["error" => "Invalid credentials."], 400);
            } 
        } catch (JWTException $e) {
            return response()->json(["error" => "Could not create token."], 500);
        }

        return response()->json([
            "token" => $token
        ]);
    }

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


    public function logout(Request $request)
    {
        // @TODO check if the token is supplied
        
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                "message" => "User logged out successfully."
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                "message" => "There was an error while trying to log the user out."
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            "token" => "required"
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json([
            "user" => $user
        ]);
    }
}
