<?php

use App\Models\Team;
use App\Models\Competition;
use Illuminate\Database\Seeder;

class TournamentTableSeeder extends Seeder
{
    protected $table = 'teams';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $competition = Competition::create(['name' => 'Competition name ' . (int) rand(0, 1000), 'year' => '2020-21']);

        $teams = factory(Team::class, 32)->create();
        $pot_counter = 1;
        $pot = 1;
        foreach ($teams as $index => $team) {
            if ($pot_counter > 8) {
                $pot++;
                $pot_counter = 1;
            }

            $competition->teams()->attach($team->id, [
                'pot' => $pot,
            ]);

            $pot_counter++;
        }
    }
}
