<?php

namespace App\Validations;

class ImageValidation extends Validation
{
    protected function defaultRules(): array
    {
        return [
            'bail',
            'image',
            'max:2048',
        ];
    }
}
