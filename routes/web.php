<?php


Route::view("/{path?}", "app");

Auth::routes();

Route::get("/home", "HomeController@index")->name("home");

Route::post("/order", "OrderController@store");

// --- TICKETS --- //
Route::resource("/ticket", "TicketController");

?>
