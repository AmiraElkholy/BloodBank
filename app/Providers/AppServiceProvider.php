<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;




use Validator;


use App\Models\Setting;
use App\Models\BloodType;


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


        //custom validation for phone numbers
        // Validator::extend('phone_number', function($attribute, $value, $parameters)
        // {
        //     return substr($value, 0, 2) == '01';
        // });


        $settings = Setting::first();
        $blood__types = BloodType::all();
        view()->share(compact('settings', 'blood__types'));



        
    }
}
