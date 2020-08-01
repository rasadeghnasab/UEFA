<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Competition;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompetitionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider getCompetitionData
     *
     * test competition year mutator
     *
     * @return void
     */
    public function competitionManipulateYearAutomatically($data, $expected_year): void
    {
        $competition = Competition::create($data);
        $competition->refresh(); // refresh the model from database data

        $this->assertEquals($expected_year, $expected_year);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCompetitionData(): array
    {
        return [
            [['name' => 'my comp 1', 'year' => 2020], '2020-2021'],
            [['name' => 'my comp 2', 'year' => '2020-2021'], '2020-2021'],
            [['name' => 'my comp 3', 'year' => '2020-21'], '2020-21'],
        ];
    }
}
