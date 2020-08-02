<?php

namespace Tests\Unit\draw;

use Tests\TestCase;
use App\Classes\Groups;
use App\Enums\GroupsNameEnum;
use App\Classes\MatchesWeeksSchedule;
use App\Enums\MatchesWeeksEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatchWeeksScheduleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * 
     * Check to see if generated table is valid or no?
     */
    public function matchWeeksScheduleTest()
    {
        $groups = $this->groups();
        $groups_mock = $this->getMockBuilder(Groups::class)
            ->disableOriginalConstructor()
            ->getMock();

        $groups_mock->method('getTable')->will($this->returnValue($groups));

        $subtests = $this->subtests();
        $schedule = new MatchesWeeksSchedule($groups_mock);

        $result = $schedule->matches();
        $weeks = [MatchesWeeksEnum::One => $result[MatchesWeeksEnum::One], MatchesWeeksEnum::Four => $result[MatchesWeeksEnum::Four]];

        foreach ($weeks as $week => $matches) {
            foreach ($matches as $index => $match) {
                $this->assertEquals($subtests[$week][$index]['home_id'], $match['home_id']);
                $this->assertEquals($subtests[$week][$index]['away_id'], $match['away_id']);
                $this->assertEquals($subtests[$week][$index]['group'], $match['group']);
                $this->assertEquals($subtests[$week][$index]['level'], $match['level']);
            }
        }
    }

    private function subtests()
    {
        return [
            MatchesWeeksEnum::One => array(
                0 => array(
                    'home_id' => 'A-1',
                    'away_id' => 'A-2',
                    'group' => 'A',
                    'level' => 'group',
                ),
                1 => array(
                    'home_id' => 'A-3',
                    'away_id' => 'A-4',
                    'group' => 'A',
                    'level' => 'group',
                ),
                2 => array(
                    'home_id' => 'B-1',
                    'away_id' => 'B-2',
                    'group' => 'B',
                    'level' => 'group',
                ),
                3 => array(
                    'home_id' => 'B-3',
                    'away_id' => 'B-4',
                    'group' => 'B',
                    'level' => 'group',
                ),
                4 => array(
                    'home_id' => 'C-1',
                    'away_id' => 'C-2',
                    'group' => 'C',
                    'level' => 'group',
                ),
                5 => array(
                    'home_id' => 'C-3',
                    'away_id' => 'C-4',
                    'group' => 'C',
                    'level' => 'group',
                ),
                6 => array(
                    'home_id' => 'D-1',
                    'away_id' => 'D-2',
                    'group' => 'D',
                    'level' => 'group',
                ),
                7 => array(
                    'home_id' => 'D-3',
                    'away_id' => 'D-4',
                    'group' => 'D',
                    'level' => 'group',
                ),
                8 => array(
                    'home_id' => 'E-1',
                    'away_id' => 'E-2',
                    'group' => 'E',
                    'level' => 'group',
                ),
                9 => array(
                    'home_id' => 'E-3',
                    'away_id' => 'E-4',
                    'group' => 'E',
                    'level' => 'group',
                ),
                10 => array(
                    'home_id' => 'F-1',
                    'away_id' => 'F-2',
                    'group' => 'F',
                    'level' => 'group',
                ),
                11 => array(
                    'home_id' => 'F-3',
                    'away_id' => 'F-4',
                    'group' => 'F',
                    'level' => 'group',
                ),
                12 =>
                array(
                    'home_id' => 'G-1',
                    'away_id' => 'G-2',
                    'group' => 'G',
                    'level' => 'group',
                ),
                13 => array(
                    'home_id' => 'G-3',
                    'away_id' => 'G-4',
                    'group' => 'G',
                    'level' => 'group',
                ),
                14 => array(
                    'home_id' => 'H-1',
                    'away_id' => 'H-2',
                    'group' => 'H',
                    'level' => 'group',
                ),
                15 => array(
                    'home_id' => 'H-3',
                    'away_id' => 'H-4',
                    'group' => 'H',
                    'level' => 'group',
                ),
            ),
            MatchesWeeksEnum::Four => array(
                0 => array(
                    'home_id' => 'A-2',
                    'away_id' => 'A-1',
                    'group' => 'A',
                    'level' => 'group',
                ),
                1 => array(
                    'home_id' => 'A-4',
                    'away_id' => 'A-3',
                    'group' => 'A',
                    'level' => 'group',
                ),
                2 => array(
                    'home_id' => 'B-2',
                    'away_id' => 'B-1',
                    'group' => 'B',
                    'level' => 'group',
                ),
                3 => array(
                    'home_id' => 'B-4',
                    'away_id' => 'B-3',
                    'group' => 'B',
                    'level' => 'group',
                ),
                4 => array(
                    'home_id' => 'C-2',
                    'away_id' => 'C-1',
                    'group' => 'C',
                    'level' => 'group',
                ),
                5 => array(
                    'home_id' => 'C-4',
                    'away_id' => 'C-3',
                    'group' => 'C',
                    'level' => 'group',
                ),
                6 => array(
                    'home_id' => 'D-2',
                    'away_id' => 'D-1',
                    'group' => 'D',
                    'level' => 'group',
                ),
                7 => array(
                    'home_id' => 'D-4',
                    'away_id' => 'D-3',
                    'group' => 'D',
                    'level' => 'group',
                ),
                8 => array(
                    'home_id' => 'E-2',
                    'away_id' => 'E-1',
                    'group' => 'E',
                    'level' => 'group',
                ),
                9 => array(
                    'home_id' => 'E-4',
                    'away_id' => 'E-3',
                    'group' => 'E',
                    'level' => 'group',
                ),
                10 => array(
                    'home_id' => 'F-2',
                    'away_id' => 'F-1',
                    'group' => 'F',
                    'level' => 'group',
                ),
                11 => array(
                    'home_id' => 'F-4',
                    'away_id' => 'F-3',
                    'group' => 'F',
                    'level' => 'group',
                ),
                12 => array(
                    'home_id' => 'G-2',
                    'away_id' => 'G-1',
                    'group' => 'G',
                    'level' => 'group',
                ),
                13 => array(
                    'home_id' => 'G-4',
                    'away_id' => 'G-3',
                    'group' => 'G',
                    'level' => 'group',
                ),
                14 => array(
                    'home_id' => 'H-2',
                    'away_id' => 'H-1',
                    'group' => 'H',
                    'level' => 'group',
                ),
                15 => array(
                    'home_id' => 'H-4',
                    'away_id' => 'H-3',
                    'group' => 'H',
                    'level' => 'group',
                ),
            )
        ];
    }

    private function groups()
    {
        $groups = [];
        foreach (GroupsNameEnum::getValues() as $group_name) {
            $groups[$group_name] = [
                sprintf('%s-1', $group_name),
                sprintf('%s-2', $group_name),
                sprintf('%s-3', $group_name),
                sprintf('%s-4', $group_name),
            ];
        }

        return $groups;
    }
}
