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
Route::group(['namespace' => 'Front'] ,function(){
  Route::get('/','MainController@home');
  Route::get('donator','MainController@donator');
  Route::get('donator/{id}','MainController@detailDonation');
  Route::get('postsAll','MainController@postsAll');
  Route::get('post/{id}','MainController@detailPost');

  Route::get('requests','MainController@request');


});

Route::get('logout',function () {
  auth()->guard()->logout();
  return redirect('login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth','auto-check-permission']],function(){

Route::resource('governorates','GovernorateController');
Route::resource('clients','ClientController');
    
    
    
Route::resource('contacts' ,'ContactController');
Route::resource('settings' ,'SettingController');

Route::post('search','ClientController@search');
    Route::resource('roles','RoleController');
    Route::get('change-password','UserController@resetPassword');
Route::post('change-password','UserController@resetPasswordSave');
    
    
    
Route::resource('posts','PostController');
Route::resource('donations','DonationController');
Route::resource('city','CityController');
Route::resource('categores','CategoryController');
Route::resource('users','UserController');




});
