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



Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {
	Route::get('governorates', 'MainController@governorates');
	Route::get('cities', 'MainController@cities');
	Route::get('blood-types', 'MainController@bloodTypes');


	
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::post('reset-password', 'AuthController@resetPassword');
	Route::post('new-password', 'AuthController@newPassword');


	Route::post('contact-us', 'MainController@contactUs');
	Route::get('settings', 'MainController@settings');



	Route::post('remove-notification-token', 'AuthController@removeNotificationToken');





	Route::group(['middleware' => 'auth:api'], function() {
		
		Route::get('posts', 'MainController@posts');
		Route::get('categories', 'MainController@categories');
		Route::get('post', 'MainController@post');

		Route::get('profile', 'AuthController@profile');
		Route::post('profile', 'AuthController@profile');


		Route::post('toggle-favourites', 'MainController@toggleFavourites');
		Route::get('favourites', 'MainController@favourites');


		Route::get('notification-settings', 'MainController@notificationSettings');
		Route::post('notification-settings', 'MainController@notificationSettings');


		Route::post('create-donation-request', 'MainController@createDonationRequest');


		Route::post('register-notification-token', 'AuthController@registerNotificationToken');






	});

});


