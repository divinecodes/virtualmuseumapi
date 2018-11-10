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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api routes for images 
//TODO add authentication 
Route::get('/v0/images','ImageController@index')->name('image.index');
Route::get('/v0/image','ImageController@show')->name('image.show'); 
Route::get('/v0/images/location','ImageController@location')->name('image.location');
Route::post('/v0/image','ImageController@store')->name('image.store');
Route::put('/v0/image','ImageController@update')->name('image.update'); 
Route::delete('/v0/image','ImageController@destroy')->name('image.destroy');

//api routes for videos 
Route::get('/v0/videos','VideoController@index')->name('video.index');
Route::get('/v0/video','VideoController@show')->name('video.show'); 
Route::get('/v0/videos/location','VideoController@location')->name('video.location');
Route::post('/v0/video','VideoController@store')->name('video.store');
Route::put('/v0/video','VideoController@update')->name('video.update'); 
Route::delete('/v0/video','VideoController@destroy')->name('video.destroy');

//api routes for locations
Route::get('/v0/locations','LocationController@index')->name('location.index');
Route::get('/v0/location','LocationController@show')->name('location.show');
Route::post('/v0/location','LocationController@store')->name('location.store');
Route::delete('/v0/location','LocationController@destroy')->name('location.destroy');