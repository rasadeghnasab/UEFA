<?php

namespace App\Enums;

final class RoundTypesEnum extends BaseEnum
{
    const ROUNDROBIN = 'round-robin';
    const SINGLEELIMINATION = 'single-elimination';
    const DOUBLEELIMINATION = 'double-elimination';
}
