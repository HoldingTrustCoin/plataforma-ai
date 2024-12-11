<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Validator::extend('two_words', function ($attribute, $value, $parameters, $validator) {
            $words = explode(' ', $value);
            return count($words) === 2;
        });
        
        Validator::replacer('two_words', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be two words.');
        });
        
        Validator::extend('digit', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/\d/', $value);
        });
        
        Validator::replacer('digit', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must contain at least one digit.');
        });
        
        Validator::extend('lowercase', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[a-z]/', $value);
        });
        
        Validator::replacer('lowercase', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must contain at least one lowercase letter.');
        });
        
        Validator::extend('uppercase', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[A-Z]/', $value);
        });
        
        Validator::replacer('uppercase', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must contain at least one uppercase letter.');
        });
        
        Validator::extend('special_character', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[\W_]/', $value);
        });
        
        Validator::replacer('special_character', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must contain at least one special character.');
        });
        

        
    }
}
