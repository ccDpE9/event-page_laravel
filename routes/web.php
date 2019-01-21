<?php


//Route::get('/concerts', 'ConcertsController@index')->name('concerts.index');

Route::view('/{path?}', 'app');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
