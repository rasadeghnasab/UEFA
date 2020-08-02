<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\CompetitionInterface;

class Competition extends Model implements CompetitionInterface
{
    protected $fillable = ['name', 'year', 'start_date'];

    protected $dates = ['start_date'];

    public function setYearAttribute($year)
    {
        $this->attributes['year'] = is_int($year) ? sprintf('%d-%d', $year, $year + 1) : $year;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'tournaments', 'competition_id', 'team_id')->withPivot('pot');
    }

    /**
     * Return all the related teams
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }
}
