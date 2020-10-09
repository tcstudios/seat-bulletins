<?php

Route::group([
    'namespace' => 'TCStudios\Seat\SeatBulletins\Http\Controllers',
    'prefix' => 'bulletins'
], function() {
    Route::group([
        'middleware' => ['web', 'auth'],
    ], function() {
        Route::get('/about', [
            'as' => 'bulletins.about',
            'uses' => 'BulletinsController@getAboutView',
            'middleware' => 'can:bulletins.view'
        ]);
    });
});