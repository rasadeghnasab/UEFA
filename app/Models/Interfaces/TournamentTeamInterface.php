<?php

namespace App\Models\Interfaces;

use App\Models\Team;
use Illuminate\Support\Collection;

interface TournamentTeamInterface
{
    public function lastXResults(Team $team, int $maches_to_look_back = 1): Collection;
}
