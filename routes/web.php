<?php

use Illuminate\Support\Facades\Route;

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

Route::match(['get','post'],'/admin/login','Admin\AuthController@login');
Route::match(['get','post'],'/admin/forgot-password','Admin\AuthController@forgot_password');
Route::match(['get','post'],'/admin/set-password/{security_code}/{user_id}','Admin\AuthController@set_password');
Route::match(['get','post'],'/admin/logout','Admin\AuthController@logout');

Route::group(['prefix'=>'admin','middleware'=>'CheckAdminAuth'],function()
{
	//------Dahboard---------------------------------------------------------------------------
	Route::get('/home','Admin\AdminController@index');
 	Route::match(['get','post'],'/reset-password','Admin\AuthController@reset_password');
    Route::match(['get','post'],'/my-profile','Admin\AuthController@my_profile');
	//------Dahboard---------------------------------------------------------------------------


	//------Manage User ---------------------------------------------------------------------------
	Route::get('/manage-users','Admin\UsersController@index');
	Route::any('/add-user','Admin\UsersController@add');
	Route::any('edit-user/{id}','Admin\UsersController@add');
	Route::any('delete-user/{id}','Admin\UsersController@delete');

	//------Manage User ---------------------------------------------------------------------------

});


Route::match(['get','post'],'/user/login','User\AuthController@login');
Route::match(['get','post'],'/user/forgot-password','User\AuthController@forgot_password');
Route::match(['get','post'],'/user/set-password/{security_code}/{user_id}','User\AuthController@set_password');
Route::match(['get','post'],'/user/logout','User\AuthController@logout');

Route::group(['prefix'=>'user','middleware'=>'CheckUserAuth'],function()
{
	//------Dahboard---------------------------------------------------------------------------
	Route::get('/home','User\AuthController@dashboard');
	Route::match(['get','post'],'/reset-password','User\AuthController@reset_password');
    Route::match(['get','post'],'/my-profile','User\AuthController@my_profile');
	//------Dahboard---------------------------------------------------------------------------
});



Route::match(['get','post'],'/chemist/login','Chemist\AuthController@login');
Route::match(['get','post'],'/chemist/forgot-password','Chemist\AuthController@forgot_password');
Route::match(['get','post'],'/chemist/set-password/{security_code}/{user_id}','Chemist\AuthController@set_password');
Route::match(['get','post'],'/chemist/logout','Chemist\AuthController@logout');

Route::group(['prefix'=>'chemist','middleware'=>'CheckChemistAuth'],function()
{
	//------Dahboard---------------------------------------------------------------------------
	Route::get('/home','Chemist\AuthController@dashboard');
	Route::match(['get','post'],'/reset-password','Chemist\AuthController@reset_password');
    Route::match(['get','post'],'/my-profile','Chemist\AuthController@my_profile');
	//------Dahboard---------------------------------------------------------------------------
});