<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::group(['prefix'=>'user'],function(){

	Route::post('/register', 'ApiController@user_registration');
	Route::post('/login', 'ApiController@user_login');
	Route::post('/logout','ApiController@logout'); 


	Route::post('/forgot-password','ApiController@forgot_password');

	Route::post('/otp-verfiy','ApiController@opt_verify');

	Route::post('/reset-password','ApiController@reset_password');


	Route::post('/get-profile','ApiController@profile'); 
	Route::post('/update-profile','ApiController@updateProfile'); 

	//======================== Book Appointment ==============================
	Route::post('/book-appointment','Api\user\AppointmentController@book_a_appointment'); 
	Route::post('/book-appointment/report','Api\user\AppointmentController@report'); 

	//======================== Book Appointment ==============================
	Route::post('/relation','Api\user\UserController@relation');
	

	Route::post('/relation/add','Api\user\UserController@realtion_add');

	Route::post('/relation-data','Api\user\UserController@relation_data');

	//------------------Edit relation -----------------------------------------
	Route::post('/relation/edit','Api\user\UserController@relation_edit');
	//------------------Edit relation -----------------------------------------


	//------------------Delete relation -----------------------------------------
	Route::post('/relation/delete','Api\user\UserController@relation_delete');
	//------------------Delete relation -----------------------------------------
});

Route::group(['prefix'=>'chemist'],function(){

	Route::post('/register', 'ChemistApiController@user_registration');
	Route::post('/login', 'ChemistApiController@user_login');
	Route::post('/logout','ChemistApiController@logout'); 
	Route::post('/forgot-password','ChemistApiController@forgot_password');
	Route::post('/reset-password','ChemistApiController@reset_password');
	Route::post('/get-profile','ChemistApiController@profile'); 
	Route::post('/update-profile','ChemistApiController@updateProfile'); 

});
