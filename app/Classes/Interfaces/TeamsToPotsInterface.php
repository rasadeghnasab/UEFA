<?php

namespace App\Classes\Interfaces;

interface TeamsToPotsInterface
{
    public function getPots(): array;

    public function getTeamsNumbers(): int;
}
