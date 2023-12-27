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
    return view('layouts.app');
});

Route::get('/create_message', 'MainController@create_message');

Route::get('/read_new_message', 'MainController@read_new_message');

Route::get('/all_messages', 'MainController@all_messages');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
