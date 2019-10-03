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
Route::get('logout',function () {
  auth()->guard()->logout();
  return redirect('login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('governorates','GovernorateController');
Route::resource('clients','ClientController');
Route::resource('contacts' ,'ContactController');
Route::resource('settings' ,'SettingController');
Route::resource('categores','CategoryController');
Route::resource('posts','PostController');
Route::resource('donations','DonationController');
Route::resource('city','CityController');
Route::resource('roles','RoleController');
Route::resource('users','UserController');
