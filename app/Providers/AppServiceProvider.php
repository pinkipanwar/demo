<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        }, "The :attribute can only have letters allowed.");

        // Only letters and numbers, no special letter
        \Validator::extend('onlyLettersNumbers', function ($attribute, $value) {
            return preg_match('/^[A-Za-z0-9\s]*$/i', $value);
        }, "The :attribute can only contain letters and numbers.");
        // only numbers allowed
        \Validator::extend('onlyNumbers', function ($attribute, $value) {
            return preg_match('/\d$/', $value);
        }, "The :attribute can only have digits allowed.");

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
