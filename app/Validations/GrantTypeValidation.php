<?php

namespace App\Validations;

class GrantTypeValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'required',
            'in:authorization_code,password,client_credentials,refresh_token'
        ];
    }
}
