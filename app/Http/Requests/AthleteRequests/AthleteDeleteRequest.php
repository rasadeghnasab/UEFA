<?php

namespace App\Http\Requests\AthleteRequests;

use Auth;
use App\Models\User;
use App\Validations\NameValidation;
use Illuminate\Foundation\Http\FormRequest;

class AthleteDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // user must have administrator permissions to do this
        $user = Auth::user() ?: new User;

        return $user->is_admin
            || $user->hasPermission('edit_athletes');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
        return [
            'name' => (new NameValidation('required'))->rules(),
        ];
    }
}
