<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Competition;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\TournamentTeamInterface;

class Team extends Model
{
    protected $fillable = ['name', 'country', 'rank', 'description'];

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'tournaments', 'team_id', 'competition_id');
    }
}
