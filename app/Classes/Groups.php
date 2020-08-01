<?php

namespace App\Classes;

use App\Models\Team;
use App\Enums\GroupsNameEnum;
use App\Classes\Interfaces\GroupInterface;
use App\Classes\Interfaces\TeamsToPotsInterface;

class Groups implements GroupInterface
{
    private $pots;
    private $table;
    private $groups_name;

    public function __construct(TeamsToPotsInterface $teamsToPots)
    {
        $this->initializeGroups();
        $this->pots = $teamsToPots;
        $this->makeTable();
    }

    /**
     * Returns the final table
     */
    public function getTable(): array
    {
        return $this->table;
    }

    /**
     * Initializing all the groups
     */
    protected function initializeGroups(): void
    {
        $this->groups_name = GroupsNameEnum::getValues();

        foreach ($this->groups_name as $group_name) {
            $this->table[$group_name] = [];
        }
    }

    /**
     * Creating tables from pots
     */
    protected function makeTable(): array
    {
        foreach ($this->pots as $pot_number => $pot) {
            while ($team = $pot->getRandomTeam()) {
                $this->chooseAGroup($team, $pot_number);
            }
        }

        return $this->getTable();
    }

    /**
     * Select a random group for the team between available groups for that team.
     * 
     * @return string
     */
    protected function chooseAGroup(Team $team, int $pot_number): string
    {
        $available_groups = $this->availableGroupsForTheTeam($pot_number);

        $group_name = $available_groups[array_rand($available_groups)];

        $this->table[$group_name][] = $team->name;

        return $group_name;
    }

    /**
     * Returns all available groups for the passed pot
     * 
     * @return array
     */
    protected function availableGroupsForTheTeam(int $pot_number): array
    {
        $available_groups = [];
        foreach ($this->table as $group_name => $group) {
            if (count($group) >= $pot_number) {
                continue;
            }

            $available_groups[] = $group_name;
        }

        return $available_groups;
    }
}
