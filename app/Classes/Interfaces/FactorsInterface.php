<?php

namespace App\Classes\Interfaces;

use App\Models\Team;
use App\Models\Schedule;

interface FactorsInterface
{
    public function handle(Schedule $schedule, Team $home): int;
}
