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

Route::get('/', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::post('/user/{id}/create', 'UserController@store');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::post('/user/{id}/edit', 'UserController@update');
Route::get('/user/{id}/delete', 'UserController@destroy');
