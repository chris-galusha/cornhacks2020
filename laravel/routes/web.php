<?php

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('lights', 'LightController');
Route::get('/lights/{light}/animate', 'LightController@animate');
Route::post('/lights/{light}/animate/update', 'LightController@animateUpdate');
Route::resource('services', 'ServiceController');
Route::resource('animations', 'AnimationController');

Route::get('/api/tokens', 'APITokenController@index');
Route::get('/api/tokens/generate', 'APITokenController@generate');
Route::post('/api/tokens', 'APITokenController@store');
Route::get('/api/tokens/{id}/regenerate', 'APITokenController@regenerate');
Route::delete('/api/tokens/{id}', 'APITokenController@destroy');
