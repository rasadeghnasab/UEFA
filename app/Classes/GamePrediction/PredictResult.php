<?php

namespace Classes\GamePrediction;

use App\Models\Team;
use App\Models\Schedule;
use Classes\GamePrediction\Interfaces\FactorsInterface;

class PredictResult
{
    protected $factors;
    protected $home_points = 0, $away_points = 0;

    public function __construct(Schedule $schedule, array $factors)
    {
        $this->schedule = $schedule;
        $this->factors = $factors;

        $this->chanceToWin();
    }

    public function matchResult()
    {
        return $this->finalResult();
    }

    private function chanceToWin(): void
    {
        $this->home_points = 0;
        $this->away_points = 0;

        foreach ($this->factors as $factor) {
            $this->home_points += $this->calculateFactorPoints($this->schedule, $this->schedule->home, $factor);
            $this->away_points += $this->calculateFactorPoints($this->schedule, $this->schedule->away, $factor);
        }
    }

    private function finalResult(): array
    {
        // calculate final results based on points each team earned.
        $home_goals = 1;
        $away_goals = 2;
        if (($this->schedule == 'final' && $home_goals === $away_goals) || $this->schedule->levelFinalResult()) {
            $extra_goals = rand(1, 4);
            $teams = ['home', 'away'];
            $random_team = $teams[array_rand($teams)];

            // Add some goals to the randomly selected team.
            $$random_team += $extra_goals;
        }

        return [
            'home' => $home_goals,
            'away' => $away_team,
        ];
    }

    /**
     * $schedule Schedule
     * $team Team
     */
    private function calculateFactorPoints(Schedule $schedule, Team $home_team, FactorsInterface $factor): int
    {
        return (new $factor)->handle($schedule, $home_team);
    }
}
