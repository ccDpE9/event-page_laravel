<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace("Api")->group(function () {
    Route::apiResource("concerts", "ConcertController");
    Gate::resource("concerts", "App\Policies\ConcertPolicy");
});

Route::group([
    "prefix" => "auth"
], function () {
    Route::post("login", "Auth\LoginController@login")->name("login");
    Route::post("register", "Auth\RegisterController@create")->name("register")->middleware("isRoot");
    /*
    Route::group([
        "middleware" => "auth:api"
    ], function() {
        Route::get("logout", "Auth\Controller@logout");
        Route::get("user", "Auth\Controller@user");
    });
     */
});

?>
