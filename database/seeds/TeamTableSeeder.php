<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    protected $table = 'teams';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $teams_data = config('teams');

        foreach ($teams_data as $team_data) {
            $team = Team::create($team_data);
        }
    }
}
