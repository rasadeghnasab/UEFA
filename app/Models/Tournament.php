<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Tournament extends Pivot
{
    protected $table = 'tournaments';

    protected $fillable = ['competition_id', 'team_id', 'pot'];
}
