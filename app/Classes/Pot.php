<?php

namespace App\Classes;

use Exception;
use App\Models\Team;
use App\Classes\Interfaces\PotInterface;

class Pot implements PotInterface
{
    private $teams;
    private $teams_number = 8;
    private $remainingTeams = false;
    private $pot_num;

    public function __construct(array $teams, int $pot_num)
    {
        $this->teams = collect([]);

        $this->addTeams($teams);
        $this->pot_num = $pot_num;
        $this->validate();
    }

    /**
     * Add an array of team to the pot
     */
    protected function addTeams(array $teams): self
    {
        foreach ($teams as $team) {
            $this->addTeam($team);
        }

        return $this;
    }

    /**
     * Return the pot number
     */
    public function getPotNum(): int
    {
        return $this->pot_num;
    }

    /**
     * Returns a random team among all the remaining teams in this pot
     *         or false if no teams left in the pot
     * 
     * @return mix (Team || null)
     */
    public function getRandomTeam()
    {
        if ($this->remainingTeams === false) {
            $this->remainingTeams = $this->teams;
        }

        if ($this->remainingTeams->isEmpty()) {
            return false;
        }

        return $this->remainingTeams->shuffle()->pop();
    }

    /**
     * Check to see if the pot is valid to begining the draw of not
     * 
     * @return boolean
     */
    public function isValid()
    {
        return $this->teams->count() == $this->teams_number;
    }

    /**
     * Add a team to the pot
     */
    protected function addTeam(Team $team): self
    {
        $this->teams->add($team);

        return $this;
    }

    /**
     * Validate the pot 
     * 
     * @throws InvalidArgumentsException
     * @return void
     */
    protected function validate()
    {
        if (!$this->isValid()) {
            throw new Exception(sprintf('Each Pot should has exactly %d teams.', $this->teams_number));
        }
    }
}
