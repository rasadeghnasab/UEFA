<?php

namespace App\Classes;

use App\Classes\Interfaces\GroupInterface;

class ScheduleGroups
{
    private $table;

    public function __construct(GroupInterface $groups)
    {
        $this->table = $groups->getTable();
    }
}
