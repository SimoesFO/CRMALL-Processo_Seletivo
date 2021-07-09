<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return "Its working!";
});


Route::prefix('users')->group(function() {
    Route::get('/', 'App\Http\Controllers\UserController@index');
    Route::get('/{id}', 'App\Http\Controllers\UserController@show');
    Route::post('/', 'App\Http\Controllers\UserController@store');
    Route::put('/{id}', 'App\Http\Controllers\UserController@update');
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');
});
