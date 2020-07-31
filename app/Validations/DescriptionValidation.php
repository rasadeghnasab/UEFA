<?php

namespace App\Validations;

class DescriptionValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'max:3071',
        ];
    }
}
