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


Route::middleware('auth:api')->group(function () {
    Route::post('/boat', 'BoatController@store')->name('api-boat-store');
    Route::put('/boat/{id}', 'BoatController@update')->name('api-boat-update');
    Route::delete('/boat/{id}', 'BoatController@delete')->name('api-boat-delete');
});
