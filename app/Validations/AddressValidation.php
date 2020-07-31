<?php

namespace App\Validations;

class AddressValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'string',
            'max:255'
        ];
    }
}
