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
use Illuminate\Support\Facades\DB;
use App\Project;
use App\Admin;


Route::get('/', function () {
    $projects = DB::table('projects')->latest('id')->limit(3)->get();

    return view('welcome', compact('projects'));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/details/{id}', 'HomeController@details')->name('details')->middleware('auth');
Route::get('/purchase/{id}', 'HomeController@purchase')->name('purchase')->middleware('auth');
Route::get('/my-projects', 'HomeController@myProjects')->name('my-projects')->middleware('auth');
Route::get('/withdraw/{id}', 'HomeController@withdraw')->name('withdraw')->middleware('auth');
// profile
Route::get('/profile', 'ProfileController@create')->name('profile')->middleware('auth');
Route::post('/profile/store', 'ProfileController@store')->name('store-profile')->middleware('auth');
Route::get('/profile/edit/', 'ProfileController@edit')->name('edit-profile')->middleware('auth');
Route::post('/profile/update', 'ProfileController@update')->name('update-profile')->middleware('auth');
// account
Route::get('/account', 'AccountController@create')->name('account')->middleware('auth');
Route::post('/account/store', 'AccountController@store')->name('store-account')->middleware('auth');
Route::get('/account/edit/', 'AccountController@edit')->name('edit-account')->middleware('auth');
Route::post('/account/update', 'AccountController@update')->name('update-account')->middleware('auth');
// kin
Route::get('/kin', 'KinController@create')->name('kin')->middleware('auth');
Route::post('/kin/store', 'KinController@store')->name('store-kin')->middleware('auth');
Route::get('/kin/edit', 'KinController@edit')->name('edit-kin')->middleware('auth');
Route::post('/kin/update', 'KinController@update')->name('update-kin')->middleware('auth');
// password update
Route::get('/password', 'PasswordChangeController@password')->name('password')->middleware('auth');
Route::post('/password/update', 'PasswordChangeController@update')->name('store-password')->middleware('auth');
// admins
Route::get('/admin/login', 'AdminController@adminLogin')->name('admin-login');
Route::post('/login/admin', 'AdminController@loginTheAdmin')->name('login-admin');
Route::middleware('auth:admin')->prefix('admin')->group(function(){
    Route::get('/home', 'AdminController@home')->name('home');
});

// projects
Route::get('/project/create', 'ProjectsController@create')->name('project')->middleware('auth:admin');
Route::post('/project/store', 'ProjectsController@store')->name('store-project')->middleware('auth:admin');
// category
Route::get('/category/create', 'CategoryController@create')->name('create-category')->middleware('auth:admin');
Route::post('/category/store', 'CategoryController@store')->name('store-category')->middleware('auth:admin');
Route::get('/category/edit', 'CategoryController@edit')->name('edit-category')->middleware('auth:admin');
Route::post('/category/update', 'CategoryController@store')->name('update-category')->middleware('auth:admin');