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

Route::get('/users', 'UserController@getUsers')->name('getUsers');
Route::get('/user/{name}', 'UserController@getUserByName')->name('getUserByName');
Route::post('/user', 'UserController@createUser')->name('createUser');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
