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
Route::get('/','Master@index')->middleware('check_login');

//User Routes

Route::get('/users/','Users@create')->name('user');

Route::post('/users/add_user','Users@store')->name('user.add_user');
Route::get('/users/show_all_users','Users@show_all_users')->name('user.show_all_users');
Route::get('/users/get_user/{id}','Users@edit')->name('user.get_user');
Route::post('/users/update_user/{id}','Users@update')->name('user.update_user');
Route::get('/users/delete_user/{id}','Users@destroy')->name('user.delete');
Route::get('/users/login/','Users@login')->name('user.login');
Route::post('/users/get_login','Users@get_login')->name('user.get_login');
Route::get('/users/logout','Users@logout')->name('user.logout');


//Location routes

Route::post('/location/get_states/','Location@get_states')->name('location.get_states');
Route::post('/location/get_cities/','Location@get_cities')->name('location.get_cities');
Route::post('location/get_countries/','Location@get_countries')->name('location.get_country');