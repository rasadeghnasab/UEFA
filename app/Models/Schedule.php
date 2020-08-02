<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['tournament_id', 'level', 'group', 'home', 'away', 'home_goals', 'away_goals', 'winner', 'due_date'];

    protected $dates = [
        'due_date',
    ];
}
