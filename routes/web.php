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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/locations','HomeController@locations')->name('location');

//routes for images 
Route::post('/image/new','ApiWrapper@addImage')->name('add.image');
Route::post('/image/update','ApiWrapper@updateImage')->name('update.image');
Route::get('/image/delete','ApiWrapper@deleteImage')->name('delete.image');

//routes for locations 
Route::post('/location/new','ApiWrapper@addLocation')->name('add.location');
Route::get('/location/delete','ApiWrapper@deleteLocation')->name('delete.location');
