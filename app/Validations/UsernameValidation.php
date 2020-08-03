<?php

namespace App\Validations;

class UsernameValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'mobileOrEmail',
            'min:8',
            'max:31'
        ];
    }
}
