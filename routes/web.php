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
use App\Admin;
use Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// profile
Route::get('/profile', 'ProfileController@create')->name('profile')->middleware('auth');
Route::post('/profile/store', 'ProfileController@store')->name('store-profile')->middleware('auth');
// account
Route::get('/account', 'AccountController@create')->name('account')->middleware('auth');
Route::post('/account/store', 'AccountController@store')->name('store-account')->middleware('auth');
// kin
Route::get('/kin', 'KinController@create')->name('kin')->middleware('auth');
Route::post('/kin/store', 'KinController@store')->name('store-kin')->middleware('auth');
// password
Route::get('/password', 'PasswordChangeController@password')->name('password')->middleware('auth');
Route::post('/password/update', 'PasswordChangeController@update')->name('store-password')->middleware('auth');
// admins
Route::get('/admin/login', 'AdminController@adminLogin')->name('admin-login');
Route::post('/login/admin', 'AdminController@loginTheAdmin')->name('login-admin');
Route::middleware('auth:admin')->prefix('admin')->group(function(){
    Route::get('/home', 'AdminController@home')->name('home');
    Route::get('/projects', 'AdminController@home')->name('projects');
});

// projects

// investments