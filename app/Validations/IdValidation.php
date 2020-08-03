<?php

namespace App\Validations;

use Illuminate\Validation\Rule;

class IdValidation extends Validation
{
    protected $table;

    public function __construct(string $table, $rules = [])
    {
        $this->table = $table;

        parent::__construct($rules);
    }

    protected function defaultRules(): array
    {
        return [
            'bail',
            'digits_between:1, 11',
            Rule::exists($this->table, 'id')
        ];
    }
}
