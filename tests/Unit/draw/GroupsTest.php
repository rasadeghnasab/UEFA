<?php

namespace Tests\Unit\draw;

use Tests\TestCase;
use App\Models\Tournament;
use App\Models\Competition;
use App\Classes\TeamsToPots;
use InvalidArgumentException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function MakeFourPotsFromThirtyTwoTeams()
    {
        Artisan::call('db:seed --class=TournamentTableSeeder');

        $teams_to_pots = new TeamsToPots(Competition::find(1));

        $this->assertCount(4, $teams_to_pots->getPots());
    }

    /**
     * @test
     *
     * @return void
     */
    public function throwsExceptionOnInvalidTeamNumber(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Teams number should be equal to %d', 32));

        Artisan::call('db:seed --class=TournamentTableSeeder');

        $competition = Competition::find(1);
        Tournament::where('competition_id', '=', 1)->where('team_id', '=', 1)->delete();

        new TeamsToPots($competition);
    }
}
