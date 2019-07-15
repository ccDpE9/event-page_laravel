<?php

use Illuminate\Http\Request;

Route::namespace("Api")->group(function () {
    Route::apiResource("concerts", "ConcertController");
    Gate::resource("concerts", "App\Policies\ConcertPolicy");
});

Route::group([
    "prefix" => "auth"
], function () {
    Route::post("login", "Api\UserController@authenticate")->name("login");
    Route::group([
        "middleware" => "auth.jwt"
    ], function() {
        Route::post("register", "Api\UserController@create")->name("register")->middleware("isRoot");
        Route::get("logout", "Api\UserController@logout");
        Route::get("user", "Api\UserController@getAuthUser");
    });
});

?>
