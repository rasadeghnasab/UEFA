<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('mobile', 'App\Rules\Mobile@passes');
        Validator::extend('mobileOrEmail', 'App\Rules\MobileOrEmail@passes');
        Validator::extend('password_format', 'App\Rules\PasswordFormat@passes');
        Validator::extend('current_password', 'App\Rules\CurrentPassword@passes');
        Validator::extend('sheba', 'App\Rules\Sheba@passes');
        Validator::extend('card_match_bank', 'App\Rules\CardMatchBank');
        Validator::extend('sheba_match_bank', 'App\Rules\ShebaMatchBank');
        Validator::extend('invalid_word', 'App\Rules\InvalidWord@passes');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
