<?php

use App\Models\Team;
use App\Models\Competition;
use Illuminate\Database\Seeder;

class TournamentTableSeederRealData extends BaseSeeder
{
    protected $table = [
        'tournaments',
        'teams'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->truncateTable($this->table);

        $teams = config('teams');
        $competition = factory(Competition::class)->create(['name' => 'UEFA Champions league', 'year' => '2020-21']);

        $pot_counter = $pot = 1;
        foreach ($teams as $team_array) {
            $team = Team::create($team_array);
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
