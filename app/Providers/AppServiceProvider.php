<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;




use Validator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        //custom vaalidation for phone numbers
        // Validator::extend('phone_number', function($attribute, $value, $parameters)
        // {
        //     return substr($value, 0, 2) == '01';
        // });


        
    }
}
