<?php

namespace App\Classes\GamePrediction;

use App\Models\Team;
use App\Models\Schedule;
use App\Classes\Interfaces\FactorsInterface;
use App\Enums\LevelsEnum;

class PredictResult
{
    protected $factors;
    protected $home_points = 0, $away_points = 0;

    public function __construct(Schedule $schedule, array $factors = null)
    {
        $this->schedule = $schedule;
        $this->factors = $factors ?? config('prediction_factors');

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
            $this->home_points += $this->calculateFactorPoints($this->schedule, $this->schedule->home, new $factor);
            $this->away_points += $this->calculateFactorPoints($this->schedule, $this->schedule->away, new $factor);
        }
    }

    private function finalResult(): array
    {
        $goals = $this->estimateGoals();

        $winner_id = $goals['home_goals'] > $goals['away_goals'] ? $this->schedule->home_id : $this->schedule->away_id;
        if ($goals['home_goals'] == $goals['away_goals']) {
            $winner_id = null;
        }

        return [
            'home_goals' => $goals['home_goals'],
            'away_goals' => $goals['away_goals'],
            'winner_id' => $winner_id,
        ];
    }

    private function estimateGoals()
    {
        $difference = abs($this->home_points - $this->away_points);
        $winner = $loser = 0;
        if ($difference <= 5) {
            $winner = rand(0, $difference);
            $loser = rand(0, $difference);
        } elseif ($difference <= 10) {
            $loser = rand(0, 2);
            $winner = $loser + rand(1, 3);
        } else {
            $loser = rand(0, 2);
            $winner = $loser + rand(2, 4);
        }

        if (($this->schedule->level == LevelsEnum::Final && $winner === $loser) || $this->schedule->levelFinalResult()) {
            $extra_goals = rand(1, 4);
            $teams = ['winner', 'loser'];
            $random_team = $teams[array_rand($teams)];

            $$random_team += $extra_goals;
        }

        return [
            'home_goals' => $this->home_points > $this->away_points ? $winner : $loser,
            'away_goals' => $this->home_points < $this->away_points ? $winner : $loser,
        ];
    }

    /**
     * $schedule Schedule
     * $team Team
     */
    private function calculateFactorPoints(Schedule $schedule, Team $home_team, FactorsInterface $factor): int
    {
        return $factor->handle($schedule, $home_team);
    }
}
