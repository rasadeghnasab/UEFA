<?php

use App\Models\Team;
use App\Models\Competition;
use Illuminate\Database\Seeder;

class TournamentTableSeeder extends Seeder
{
    protected $table = 'tournaments';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $teams = factory(Team::class, 32)->create();
        $competition = factory(Competition::class)->create();

        $pot_counter = $pot = 1;
        foreach ($teams as $team) {
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
