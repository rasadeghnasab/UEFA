<?php

namespace App\Providers;

use Faker\Generator;
use Faker\Provider\fa_IR\PhoneNumber;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function ($app) {

            $faker = \Faker\Factory::create(config('app.faker_locale'));
            $faker->addProvider(new PhoneNumber($faker));

            return $faker;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
