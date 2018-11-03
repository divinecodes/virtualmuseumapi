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
Route::post('/v0/image','ImagesController@store')->name('image.store');
Route::put('/v0/image','ImagesController@update')->name('image.update'); 
Route::delete('/v0/image','ImagesController@destroy')->name('image.destroy');
