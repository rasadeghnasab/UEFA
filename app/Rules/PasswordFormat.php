<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $conditions = config('password.conditions');

        $valid = array_reduce($conditions, function ($valid, $condition) use ($value) {
            $check = $condition['check'] ? preg_match($condition['regex'], $value) : true;

            return $check && $valid;
        }, true);

        $lengthCheck = config('password.min-length');
        $length = $lengthCheck['check'] ? strlen($value) >= $lengthCheck['length'] : true;

        return $valid & $length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.password');
    }
}
