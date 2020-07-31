<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // This should be call one time.
        // $this->call(ProvinceSeeder::class);
        $this->call([
            SportSeeder::class,
            CitySportSeeder::class,
            BeltSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
