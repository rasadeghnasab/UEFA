<?php

namespace App\Classes\GamePrediction\Factors;

use Exception;
use App\Models\Team;
use App\Models\Schedule;
use App\Models\Interfaces\TournamentTeamInterface;
use App\Classes\Interfaces\FactorsInterface;

/**
 * Did the team win the last match? +2/-3 (how many matches they've won in a row)
 */
class Mentality implements FactorsInterface
{
    private $check_last_x_matches = 3;

    public function handle(Schedule $schedule, Team $team): int
    {
        if (!$schedule instanceof TournamentTeamInterface) {
            throw new Exception('LastMatchesResult argument 1 should implements TournamentTeamInterface');
        }

        $matches = $schedule->lastXResults($team, $this->check_last_x_matches);

        $points = 0;
        foreach ($matches as $index => $match) {
            if (is_null($match->winner_id)) {
                $opponent_rank = $match->home->rank == $team->rank ? $match->away->rank : $match->home->rank;
                $points += $opponent_rank > $team->rank ? round($index / 2) : -1 * round($index / 2);

                continue;
            }
            $points += $match->winner_id == $team->id ? $this->check_last_x_matches - $index : (-1 * $this->check_last_x_matches) + $index;
        }

        return (int) $points;
    }
}
