<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1'], function () {
    /*
    |--------------------------------------------------------------------------
    | Admin - Panel API Routes
    |--------------------------------------------------------------------------
    */
    Route::group(
        [
            'prefix' => 'admin',
            'namespace' => 'Admin'
        ],
        function () {
            /*
            |--------------------------------------------------------------------------
            | ADMIN / PROPERTIES
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'property'], function () {
                Route::post('/list', 'PropertyController@list');
                Route::post('/create', 'PropertyController@create');
                Route::post('/get', 'PropertyController@get');
                Route::group(['prefix' => '{property}'], function () {
                    Route::post('/update', 'PropertyController@update');
                    Route::post('/delete', 'PropertyController@delete');
                });
            });
            /*
            |--------------------------------------------------------------------------
            | ADMIN / PROPERTIES TYPES
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'propertyType'], function () {
                Route::post('/list', 'PropertyTypeController@list');
            });
    });
});