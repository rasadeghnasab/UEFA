<?php

namespace App\Classes;

use App\Classes\Pot;
use App\Models\Team;
use InvalidArgumentException;
use App\Models\Interfaces\CompetitionInterface;

class TeamsToPots
{
    private $teams_number = 32;
    private $teams;
    private $pots = [];

    public function __construct(CompetitionInterface $competition)
    {
        $this->teams = $competition->getTeams();
        $this->teamsToPots();
    }

    /**
     * Returns array of Pots objects
     */
    public function getPots(): array
    {
        return $this->pots;
    }

    /**
     * Turns teams to groups of pots
     */
    protected function teamsToPots(): void
    {
        $this->validate();

        $pots = [];
        foreach ($this->teams as $team) {
            $pots[$team->pivot->pot][] = $team;
        }

        foreach ($pots as $pot_num => $teams) {
            $this->pots[$pot_num] = new Pot($teams, $pot_num);
        }
    }

    /**
     * Make expected teams number public
     */
    public function getTeamsNumber()
    {
        return $this->teams_number;
    }

    /**
     * Count existing teams on the competition
     * 
     * @returns 
     */
    public function countTeams(): int
    {
        return count($this->teams);
    }

    /**
     * Validate competition number of teams and each team'e type
     */
    private function validate(): void
    {
        if ($this->teams_number != $this->countTeams()) {
            throw new InvalidArgumentException(sprintf('Teams number should be equal to %d', $this->teams_number));
        }

        foreach ($this->teams as $team) {
            if ($team instanceof Team) {
                continue;
            }

            throw new InvalidArgumentException(sprintf('Each team should be an instance of %s', Team::class));
        }
    }
}
