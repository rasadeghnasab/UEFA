<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillables = ['name', 'year'];

    public function setYearAttribute($year)
    {
        $this->attributes['year'] = is_int($year) ? sprintf('%d-%d', $year, $year + 1) : $year;
    }

    public function teams()
    {
        return $this->belongsToMany(App\Models\Team::class, 'tournaments', 'competition_id', 'team_id');
    }
}
