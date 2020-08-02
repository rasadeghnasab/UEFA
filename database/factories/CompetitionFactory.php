<?php

use App\Models\Competition;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Competition::class, function (Faker $faker) {
    return [
        'name' => sprintf('Competition %s', $faker->numberBetween(1, 30)),
        'year' => $faker->numberBetween(2016, 2021),
        'start_date' => $faker->dateTimeBetween('now', '+7 days'),
    ];
});
