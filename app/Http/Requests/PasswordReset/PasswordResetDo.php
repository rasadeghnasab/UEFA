<?php

namespace App\Http\Requests\PasswordReset;

use Auth;
use App\Validations\MobileValidation;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetDo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // user must be logged in
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'password'
        ];
    }
}
