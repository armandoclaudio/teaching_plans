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
Route::get('/', 'PlansController@index')->name('plans.index');
Route::get('/plans/create', 'PlansController@create')->name('plans.create');
Route::post('/plans/create', 'PlansController@store')->name('plans.store');
Route::get('/plans/{id}', 'PlansController@show')->name('plans.show');
Route::get('/plans/{id}/get/', 'PlansController@get')->name('plans.get');
Route::get('/plans/{id}/edit/', 'PlansController@edit')->name('plans.edit');
Route::post('/plans/{id}', 'PlansController@update')->name('plans.update');
Route::delete('/plans/{id}', 'PlansController@delete')->name('plans.delete');

Route::get('/standards', 'StandardsController@index')->name('standards.index');
Route::get('/standards/all', 'StandardsController@all')->name('standards.all');
Route::get('/standards/create', 'StandardsController@create')->name('standards.create');
Route::get('/standards/{id}', 'StandardsController@edit')->name('standards.edit');
Route::post('/standards/create', 'StandardsController@store')->name('standards.store');
Route::post('/standards/{id}', 'StandardsController@update')->name('standards.update');
Route::get('/standards/{id}/get', 'StandardsController@get')->name('standards.get');

Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
