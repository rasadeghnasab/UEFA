<?php

namespace App\Http\Requests\PasswordReset;

use App\Validations\CodeValidation;
use App\Validations\MobileValidation;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetCodeVerify extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // User Auth doesn't not checked,
        // because only guest users can perform this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => (new MobileValidation)->required()->mustExists()->rules(),
            'code' => (new CodeValidation)->required()->rules(),
        ];
    }
}
