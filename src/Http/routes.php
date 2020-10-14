<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'TCStudios\Seat\SeatBulletins\Http\Controllers',
    'prefix' => 'bulletins'
], function() {
    Route::group([
        'middleware' => ['web', 'auth'],
    ], function() {
        Route::get('/', [
            'as' => 'bulletins.list',
            'uses' => 'BulletinsController@getListView',
            'middleware' => 'can:bulletins.view'
        ]);
        Route::get('/about', [
            'as' => 'bulletins.about',
            'uses' => 'BulletinsController@getAboutView',
            'middleware' => 'can:bulletins.view'
        ]);
        Route::get('/manage', [
            'as' => 'bulletins.manage',
            'uses' => 'BulletinsController@getManageView',
            'middleware' => 'can:bulletins.create'
        ]);
        Route::post('/save', [
            'as' => 'bulletins.saveBulletin',
            'uses' => 'BulletinsController@saveBulletin',
            'middleware' => 'can:bulletins.create'
        ]);
        Route::post('/delete', [
            'as' => 'bulletins.deleteBulletin',
            'uses' => 'BulletinsController@deleteBulletin',
            'middleware' => 'can:bulletins.create'
        ]);
    });
});