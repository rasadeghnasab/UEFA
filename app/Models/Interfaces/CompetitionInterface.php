<?php

namespace App\Models\Interfaces;

use Illuminate\Support\Collection;

interface CompetitionInterface
{
    public function getTeams(): Collection;
}
