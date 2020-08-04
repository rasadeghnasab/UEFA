<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\TournamentTeamInterface;

class Schedule extends Model implements TournamentTeamInterface
{
    protected $fillable = ['competition_id', 'level', 'group', 'home_id', 'away_id', 'home_goals', 'away_goals', 'winner', 'due_date'];

    protected $dates = [
        'due_date',
    ];

    public function home()
    {
        return $this->belongsTo(Team::class, 'home_id');
    }

    public function away()
    {
        return $this->belongsTo(Team::class, 'away_id');
    }

    public function lastXResults(Team $team, int $maches_to_look_back = 1): Collection
    {
        return $this->tournament()
            ->where(function ($query) use ($team) {
                $query->where('home_id', $team->id)->orWhere('away_id', $team->id);
            })
            ->orderBy('due_date', 'desc')
            ->limit($maches_to_look_back)
            ->get();
    }
}
