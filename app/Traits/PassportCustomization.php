<?php

namespace App\Traits;

use App\Rules\Mobile;

trait PassportCustomization
{
    public function findForPassport($value)
    {
        return $this->where($this->passportSelectUsernameFromValue($value), $value)->first();
    }

    private function passportSelectUsernameFromValue(string $value): string
    {
        return $this->isMobile($value) ? 'mobile' : 'email';
    }

    private function isMobile($value): bool
    {
        // check to see if entered value is mobile number
        return (new Mobile())->passes(null, $value);
    }
}
