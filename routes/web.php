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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::group(['namespace' => 'Front'], function() {
    Route::get('sign-in', 'AuthController@showLoginForm')->name('clientsLogin');
    Route::post('sign-in', 'AuthController@login')->name('clientsLoginSubmit');
    Route::get('sign-up', 'AuthController@showRegisterForm')->name('clientsRegister');
    Route::post('sign-up', 'AuthController@register')->name('clientsRegisterSubmit');
    Route::post('sign-out', 'AuthController@logout')->name('clientsLogout');
    Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('clientsResetPage');
    Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('clientsResetLinkRequest');
    Route::get('change-password/{token}', 'ResetPasswordController@showResetForm')->name('clientsChangePasswordForm');
    Route::post('change-password', 'ResetPasswordController@reset')->name('clientsChangePassword');



    Route::get('about', 'MainController@about')->name('about');
    Route::get('contact', 'MainController@contact')->name('contact');
    Route::post('contact-us', 'MainController@contactUs')->name('contact-us');    
});



Route::group(['middleware' => ['auth:client-web'], 'namespace' => 'Front'], function () {
    Route::get('/', 'MainController@home')->name('home');
    Route::get('home', 'MainController@home');
    Route::get('profile', 'MainController@profile')->name('profile');
    Route::get('profile/edit', 'MainController@editProfile')->name('editProfile');
    Route::post('profile/update', 'MainController@updateProfile')->name('updateProfile');
    Route::post('toggle-favourites', 'MainController@toggleFavourites')->name('toggleFavouritesWeb');
    Route::resource('posts', 'PostController');
    Route::get('favourites', 'PostController@listFavourites')->name('favourites');
    Route::get('posts/category/{id}', 'PostController@listPostsByCategory');
    Route::resource('donation-requests', 'DonationRequestController');
    Route::post('donation-requests/store', 'DonationRequestController@store')->name('clients.donation-requests.store');
    Route::post('donation-requests', 'DonationRequestController@index');
});




Route::group(['middleware' => ['auth:web', 'auto-check-permission'], 'prefix' => 'admin'], function() { 
    
    Route::resource('governorates', 'GovernorateController');
    Route::resource('cities', 'CityController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('clients', 'ClientController');
    Route::get('toggle-activation/{id}', 'ClientController@toggleActivation')->name('clients.toggleActivation');
    Route::resource('contact-messages', 'ContactMessageController');
    Route::resource('donation-requests', 'DonationRequestController');
    Route::resource('settings', 'SettingController');
    //using Laravel Entrust package
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    //change password for admin
    Route::get('reset-password', 'UserController@editPassword')->name('users.editPassword');
    Route::post('reset-password', 'UserController@updatePassword')->name('users.updatePassword');
    Route::get('/', 'HomeController@index')->name('adminHome');
   
});

    Route::post('admin/logout', 'HomeController@logout')->name('adminLogout');

