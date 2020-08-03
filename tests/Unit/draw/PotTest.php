<?php

namespace Tests\Unit\draw;

use Exception;
use Tests\TestCase;
use App\Classes\Pot;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use TypeError;

class PotTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function potFailsIfWeAreTryingToAddInvalidNumberOfTeams()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('Each Pot should has exactly %d teams.', 8));

        $teams = factory(Team::class, 9)->create()->all();

        new Pot($teams, 1);
    }

    /**
     * @test
     */
    public function potFailsIfWeAreTryingToAddInvalidTeams()
    {
        $this->expectException(TypeError::class);

        $teams = factory(Team::class, 5)->create()->all();
        $teams = array_merge($teams, [[], [], '']);

        new Pot($teams, 1);
    }
}
