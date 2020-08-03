<?php

namespace App\Http\Requests;

use App\Rules\Mobile;
use App\Rules\MobileOrEmail;
use App\Validations\GrantTypeValidation;
use App\Validations\PasswordValidation;
use App\Validations\UsernameValidation;
use Illuminate\Foundation\Http\FormRequest;

class AccessTokenRequest extends FormRequest
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
            'username' => (new UsernameValidation())->rules(),
            'password' => 'required',
            'grant_type' => (new GrantTypeValidation())->rules()
        ];
    }
}
