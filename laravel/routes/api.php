<?php

use Illuminate\Http\Request;

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
  Route::post('/animations', 'AnimationController@store');
  Route::post('/animations/play', 'AnimationController@play');
});

//Tokens
Route::post('/tokens/request', 'APITokenController@requestToken');
