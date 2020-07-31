<?php

namespace App\Validations;

class EmailValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'email',
            'unique:users,email',
            'min:10',
            'max:63',
        ];
    }
}
