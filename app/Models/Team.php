<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillables = ['name', 'country', 'rank', 'description'];

    public function competitions()
    {
        return $this->belongsToMany(App\Models\Competition::class, 'tournaments', 'team_id', 'competition_id');
    }
}
