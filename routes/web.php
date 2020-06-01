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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index');


Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () { 
    Route::resource('governorate', 'GovernorateController');
    Route::resource('city', 'CityController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('client', 'ClientController');
    Route::get('toggle-activation/{id}', 'ClientController@toggleActivation')->name('client.toggleActivation');
    Route::resource('contact-message', 'ContactMessageController');
    Route::resource('donation-request', 'DonationRequestController');
    Route::resource('setting', 'SettingController');

   
});
