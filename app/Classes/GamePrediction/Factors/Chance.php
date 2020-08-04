<?php

namespace App\Classes\GamePrediction\Factors;

use App\Models\Team;
use App\Models\Schedule;
use App\Classes\Interfaces\FactorsInterface;

/**
 * Chance factor. Can be a random between(-4, +4) for each team
 */
class Chance implements FactorsInterface
{
    public function handle(Schedule $schedule, Team $home): int
    {
        return rand(-4, +4);
    }
}
