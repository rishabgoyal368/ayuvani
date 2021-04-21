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

	//------Dahboard---------------------------------------------------------------------------


	//------Manage User ---------------------------------------------------------------------------
	Route::get('/manage-users','Admin\UsersController@index');
	Route::any('/add-user','Admin\UsersController@add');
	Route::any('edit-user/{id}','Admin\UsersController@add');
	Route::any('delete-user/{id}','Admin\UsersController@delete');

	//------Manage User ---------------------------------------------------------------------------

});