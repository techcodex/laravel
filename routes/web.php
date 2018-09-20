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
//Master Controller
Route::get('/','Master@index');

//User Routes

Route::get('/users/','Users@create')->name('user');

Route::post('/users/add_user','Users@store')->name('user.add_user');
Route::get('/users/show_all_users','Users@show_all_users')->name('user.show_all_users');
Route::get('/users/get_user/{id}','Users@edit')->name('user.get_user');
Route::post('/users/update_user/{id}','Users@update')->name('user.update_user');