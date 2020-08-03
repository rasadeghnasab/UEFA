<?php

namespace Tests\Unit\draw;

use Tests\TestCase;
use App\Classes\Groups;
use App\Models\Competition;
use App\Classes\TeamsToPots;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * 
     * Check to see if generated table is valid or no?
     */
    public function checkTableValidity()
    {
        Artisan::call('db:seed --class=TournamentTableSeederRealData');
        $expected_pots = collect(config('teams'))->chunk(8);

        $pots = new TeamsToPots(Competition::find(1));
        $table = (new Groups($pots))->getTable();

        foreach ($expected_pots as $pot_num => $expected_pot) {
            foreach ($table as $group) {
                $this->assertTrue(in_array($group[$pot_num], $expected_pot->pluck('name')->toArray()));
            }
        }
    }
}
