<?php

use Illuminate\Http\Request;

Route::namespace("Api")->group(function () {
    Route::apiResource("concerts", "ConcertController");
    Gate::resource("concerts", "App\Policies\ConcertPolicy");
});

Route::group([
    "prefix" => "auth"
], function () {
    Route::post("login", "Api\AuthController@authenticate")->name("login");
    Route::group([
        "middleware" => "auth.jwt"
    ], function() {
        Route::post("register", "Api\UserController@create")->name("user.create")->middleware("isRoot");
        Route::post("update", "Api\UserController@update")->name("user.update");
        Route::get("logout", "Api\AuthController@logout")->name("logout");
        Route::get("user", "Api\AuthController@getAuthUser");
    });
});

?>
