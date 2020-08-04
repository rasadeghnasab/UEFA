<?php

namespace App\Classes\GamePrediction\Factors;

use App\Models\Team;
use App\Models\Schedule;
use App\Classes\Interfaces\FactorsInterface;

/**
 * Sub team rank for team rankings <= 20
 */
class Ranking implements FactorsInterface
{
    public function handle(Schedule $schedule, Team $team): int
    {
        return $team->rank >= 20 ? -20 : -$team->rank;
    }
}
