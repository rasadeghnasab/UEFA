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
        $this->call([
            TournamentTableSeederRealData::class,
            UserTableSeeder::class,
        ]);
    }
}
