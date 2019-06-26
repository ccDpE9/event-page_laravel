<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace("Api")->group(function () {
    Route::apiResource("concerts", "ConcertController");
    Gate::resource("concerts", "App\Policies\ConcertPolicy");
});
