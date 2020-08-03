<?php

namespace App\Validations;

class ArrayInputValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'required',
            'array',
            'min:1',
        ];
    }
}
