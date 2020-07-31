<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    protected $table = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class)->create();
        User::destroy(1);

        User::create([
            'first_name' => 'رامین',
            'last_name'  => 'صادق نسب',
            'mobile'     => '09016473127',
            'email'      => 'rasadeghnasab@gmail.com',
            'password'   => Hash::make('password'),
            'city_id'    => 19,
        ]);

        factory(User::class, 20)->create();
    }
}
