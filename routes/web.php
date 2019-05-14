<?php


//Route::get('/concerts', 'ConcertsController@index')->name('concerts.index');

Route::view('/{path?}', 'app');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/order', 'OrderController@store');
