<?php

namespace Classes\GamePrediction\Factors;

use App\Models\Team;
use App\Models\Schedule;
use Classes\GamePrediction\Interfaces\FactorsInterface;

/**
 * (1/The team rank) * 5
 */
class Ranking implements FactorsInterface
{
    protected $multiply_to = 5;

    public function handle(Schedule $schedule, Team $team): int
    {
        return ceil(1 / $team->rank) * $this->multiply_to;
    }
}
