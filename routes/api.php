<?php

use Illuminate\Http\Request;

Route::namespace("Api")->group(function () {
    Route::get("/concerts/index", "ConcertController@index")->name("concerts.index");
    Route::group([
        "middleware" => "jwt.verify",
    ], function() {
        Route::post("/concerts/store", "ConcertController@store")->name("concerts.store")->middleware("jwt.verify");
        Route::post("/concerts/show/{concert}", "ConcertController@show")->name("concerts.show")->middleware("jwt.verify");
        Route::put("/concerts/update/{concert}", "ConcertController@update")->name("concerts.update")->middleware("jwt.verify");
        Route::delete("/concerts/delete/{concert}", "ConcertController@destroy")->name("concerts.destroy")->middleware("jwt.verify");
    });
});

Route::group([
    "prefix" => "auth"
], function () {
    Route::post("login", "Api\AuthController@authenticate")->name("login");
    Route::group([
        "middleware" => "jwt.verify"
    ], function() {
        Route::post("register", "Api\UserController@create")->name("user.create")->middleware("isRoot");
        Route::post("update", "Api\UserController@update")->name("user.update");
        Route::get("logout", "Api\AuthController@logout")->name("logout");
        Route::get("user", "Api\AuthController@getAuthUser");
    });
});

?>
