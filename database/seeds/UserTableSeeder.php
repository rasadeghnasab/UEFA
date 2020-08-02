<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends BaseSeeder
{
    protected $table = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->truncateTable($this->table);

        User::create([
            'first_name' => 'رامین',
            'last_name'  => 'صادق نسب',
            'email'      => 'rasadeghnasab@gmail.com',
            'password'   => Hash::make('password'),
        ]);

        factory(User::class, 20)->create();
    }
}
