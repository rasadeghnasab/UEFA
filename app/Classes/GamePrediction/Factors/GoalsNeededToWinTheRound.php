<?php

namespace Classes\GamePrediction\Factors;

use App\Models\Team;
use Classes\GamePrediction\Interfaces\FactorsInterface;

/**
 * How many goals they will need to go to the next level
 * 	x <= 3 (+5)
 *  x == 0 (+2)
 *  3 < x < 5 (+1)
 *  x >= 5 (-2)
 */
class GoalsNeededToWinTheRound implements FactorsInterface
{
    public function handle(Team $home, string $field): int
    {
        return 10;
    }
}
