<?php

use App\Models\Team;
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

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => sprintf('Team %d', $faker->numberBetween(1, 30)),
        'country' => $faker->country,
        'rank' => $faker->numberBetween(1, 32),
    ];
});
