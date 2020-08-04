<?php

namespace App\Classes\GamePrediction\Factors;

use App\Models\Team;
use App\Models\Schedule;
use App\Classes\Interfaces\FactorsInterface;
use App\Enums\LevelsEnum;

/**
 * is home or away +5/-2
 */
class Field implements FactorsInterface
{
    public function handle(Schedule $schedule, Team $home): int
    {
        // Final match always plays in third party stadium.
        if ($schedule->level === LevelsEnum::Final) {
            return 0;
        }

        if ($schedule->home_id == $home->id) {
            return rand(3, 5);
        }

        return rand(-2, 0);
    }
}
