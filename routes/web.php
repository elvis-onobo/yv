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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// profile
Route::get('/profile', 'ProfileController@create')->name('profile')->middleware('auth');
Route::post('/profile/store', 'ProfileController@store')->name('store-profile')->middleware('auth');
// password
Route::get('/update-password', 'HomeController@index')->name('update-password')->middleware('auth');
// account
Route::get('/account', 'AccountController@create')->name('account')->middleware('auth');
Route::post('/account/store', 'AccountController@store')->name('store-account')->middleware('auth');
// kin
Route::get('/kin', 'KinController@create')->name('kin')->middleware('auth');
Route::post('/kin/store', 'KinController@store')->name('store-kin')->middleware('auth');
