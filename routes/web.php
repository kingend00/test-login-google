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
    return view('auth.login');
});
Route::get('/auth/{provider}', 'AuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'AuthController@handleProviderCallback');
Route::get('/admin','InfoAdmin@index');
Route::post('/admin/edit','InfoAdmin@edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
