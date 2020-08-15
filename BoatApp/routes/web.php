<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Boat
Route::get('/boat/list', 'BoatController@list')->name('boat-list');
Route::get('/boat', 'BoatController@create')->name('boat-create');
Route::get('/boat/{id}', 'BoatController@show')->name('boat-show');
Route::get('/boat/{id}/edit', 'BoatController@edit')->name('boat-edit');
