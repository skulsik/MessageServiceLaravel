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

Route::get('/form_message', 'MainController@form_message')->name('form_message');

Route::post('/create_message', 'MainController@create_message')->name('create_message');

Route::get('/read_new_message', 'MainController@read_new_message');

Route::get('/all_messages', 'MainController@all_messages')->name('all_messages');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
