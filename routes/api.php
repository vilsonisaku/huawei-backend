<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register','UserController@register');
Route::post('login','UserController@login');

Route::middleware('auth')->group( function () {
    Route::post('check/token','UserController@checkToken');
    Route::get('users','UserController@getAll');
    Route::get('users/{id}','UserController@find');
});
