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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@show')->name('home');

Route::post('/home', 'HomeController@show')->name('home');

Route::get('/user/{id}', 'UserController@show')->name('profil');

Route::get('/user/{id}/edit', 'UserController@edit')->name('profil_edit');

Route::post('/user/{id}/edit', 'UserController@update')->name('edit');

Route::get('/annonces/new', 'AnnoncesController@display_new_annonce')->name('annonce');

Route::post('/annonces/send', 'AnnoncesController@send_new_annonce')->name('send_annonce');