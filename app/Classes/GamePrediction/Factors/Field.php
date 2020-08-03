<?php

namespace Classes\GamePrediction\Factors;

use App\Models\Team;
use App\Models\Schedule;
use Classes\GamePrediction\Interfaces\FactorsInterface;

/**
 * is home or away +5/-2
 */
class Field implements FactorsInterface
{
    public function handle(Schedule $schedule, Team $home): int
    {
        if ($schedule->home_id == $home->id) {
            return rand(3, 5);
        }

        return rand(-2, 0);
    }
}
