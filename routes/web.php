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
// profile
Route::get('/profile', 'ProfileController@create')->name('profile');
Route::get('/update-password', 'HomeController@index')->name('update-password');
Route::post('/profile/store', 'ProfileController@store')->name('store-profile');
// account
Route::get('/account', 'AccountController@create')->name('account');
// kin
Route::get('/kin', 'KinController@create')->name('kin');
