<?php

namespace App\Validations;

use Auth;
use Illuminate\Validation\Rule;

class CurrentPasswordValidation extends Validation
{
    protected $different;

    public function __construct(string $different = 'password', $rules = [])
    {
        $this->different = $different;

        parent::__construct($rules);
    }

    protected function defaultRules(): array
    {
        return [
            'bail',
            'required',
            'password',
            'different:' . $this->different,
            'current_password',
        ];
    }
}
