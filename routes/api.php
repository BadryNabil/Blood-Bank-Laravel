<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1' ,'namespace'=>'Api'],function(){
  /**********************MainControllers***********************/
  Route::get('governorates','MainControllers@governorates');
  Route::get('cities','MainControllers@cities');
  Route::get('settings','MainControllers@settings');
  Route::get('blood_types','MainControllers@blood_types');
  Route::get('categories','MainControllers@categories');


  /*****************AuthControllers****************/
  Route::post('register','AuthControllers@register');
  Route::post('login','AuthControllers@login');
  Route::post('reset_password','AuthControllers@reset_password');
  Route::post('new_password','AuthControllers@new_password');

/***********************middleware*********************/
//Route::group(['middleware'=>['auth','auto-check-permission']],function(){
Route::group(['middleware'=>'auth:api'],function(){

  Route::get('posts','MainControllers@posts');
  Route::get('myfavourites-posts','MainControllers@myFavouritesPost');
  Route::post('post-favourite','MainControllers@FavouritesPost');
  Route::post('register_token','AuthControllers@register_token');
  Route::post('remove_token','AuthControllers@remove_token');
  Route::post('donation_request','MainControllers@donation_request');
  Route::post('update-notification-settings','AuthControllers@updateNotificationSettings');
  Route::post('get-notification-settings','AuthControllers@getNotificationSettings');
  Route::post('contact','AuthControllers@contact');
  Route::get('notifications-list','AuthControllers@notificationList');
  Route::get('notifications-count','MainControllers@notificationsCount');
  Route::get('notifications-count-isread','MainControllers@notificationsCountIsread');
 });
});
