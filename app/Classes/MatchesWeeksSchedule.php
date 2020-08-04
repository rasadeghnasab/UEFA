<?php

namespace App\Classes;

use App\Enums\LevelsEnum;
use App\Models\Competition;
use App\Enums\GroupsNameEnum;
use App\Enums\MatchesWeeksEnum;
use App\Classes\Interfaces\GroupInterface;

class MatchesWeeksSchedule
{
    private $matches_calendar = [];

    public function __construct(GroupInterface $groups)
    {
        $this->makeSchedule($groups->getTable());
    }

    public function matches(Competition $competition = null)
    {
        if (is_null($competition)) {
            return $this->matches_calendar;
        }

        $matches_calendar = [];
        foreach ($this->matches_calendar as $week => $games) {
            foreach ($games as $game) {
                $matches_calendar[$week][] = array_merge($game, ['competition_id' => $competition->id, 'due_date' => $competition->start_date->addWeeks($week - 1)->format('Y-m-d')]);
            }
        }

        return $this->matches_calendar = $matches_calendar;
    }

    private function makeSchedule($table)
    {
        // Group-level
        $this->scheduleGroupsMatchs($table);

        // 1/8
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::C, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::D, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::E, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::F, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::G, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Six][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::H, 'level' => LevelsEnum::OneEighth];

        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::C, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::D, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::E, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::F, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::G, 'level' => LevelsEnum::OneEighth];
        $this->matches_calendar[MatchesWeeksEnum::Seven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::H, 'level' => LevelsEnum::OneEighth];

        // 1/4
        $this->matches_calendar[MatchesWeeksEnum::Eight][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Eight][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Eight][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::C, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Eight][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::D, 'level' => LevelsEnum::OneFourth];

        $this->matches_calendar[MatchesWeeksEnum::Nine][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Nine][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Nine][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::C, 'level' => LevelsEnum::OneFourth];
        $this->matches_calendar[MatchesWeeksEnum::Nine][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::D, 'level' => LevelsEnum::OneFourth];

        // Semi-final
        $this->matches_calendar[MatchesWeeksEnum::Ten][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::SemiFinal];
        $this->matches_calendar[MatchesWeeksEnum::Ten][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::SemiFinal];

        $this->matches_calendar[MatchesWeeksEnum::Eleven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::SemiFinal];
        $this->matches_calendar[MatchesWeeksEnum::Eleven][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::B, 'level' => LevelsEnum::SemiFinal];

        // Classification
        $this->matches_calendar[MatchesWeeksEnum::Twelve][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::Classfication];

        // Final
        $this->matches_calendar[MatchesWeeksEnum::Thirteen][] = ['home_id' => null, 'away_id' => null, 'group' => GroupsNameEnum::A, 'level' => LevelsEnum::Final];
    }

    private function scheduleGroupsMatchs(array $table): void
    {
        foreach ($table as $group_name => $group) {
            $matches = $this->groupLevelMatches($group, $group_name);

            foreach ($matches as $week => $match) {
                $this->matches_calendar[$week] = array_merge($this->matches_calendar[$week] ?? [], $match);
            }
        }
    }

    private function groupLevelMatches(array $group, string $group_name): array
    {
        $group_level_matches = [];

        $group_level_matches[MatchesWeeksEnum::Zero][] = ['home_id' => $group[0], 'away_id' => $group[1], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::Zero][] = ['home_id' => $group[2], 'away_id' => $group[3], 'group' => $group_name, 'level' => LevelsEnum::Group];

        $group_level_matches[MatchesWeeksEnum::One][] = ['home_id' => $group[0], 'away_id' => $group[2], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::One][] = ['home_id' => $group[1], 'away_id' => $group[3], 'group' => $group_name, 'level' => LevelsEnum::Group];

        $group_level_matches[MatchesWeeksEnum::Two][] = ['home_id' => $group[0], 'away_id' => $group[3], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::Two][] = ['home_id' => $group[1], 'away_id' => $group[2], 'group' => $group_name, 'level' => LevelsEnum::Group];

        $group_level_matches[MatchesWeeksEnum::Three][] = ['home_id' => $group[1], 'away_id' => $group[0], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::Three][] = ['home_id' => $group[3], 'away_id' => $group[2], 'group' => $group_name, 'level' => LevelsEnum::Group];

        $group_level_matches[MatchesWeeksEnum::Four][] = ['home_id' => $group[2], 'away_id' => $group[0], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::Four][] = ['home_id' => $group[3], 'away_id' => $group[1], 'group' => $group_name, 'level' => LevelsEnum::Group];

        $group_level_matches[MatchesWeeksEnum::Five][] = ['home_id' => $group[3], 'away_id' => $group[0], 'group' => $group_name, 'level' => LevelsEnum::Group];
        $group_level_matches[MatchesWeeksEnum::Five][] = ['home_id' => $group[2], 'away_id' => $group[1], 'group' => $group_name, 'level' => LevelsEnum::Group];

        return $group_level_matches;
    }
}
