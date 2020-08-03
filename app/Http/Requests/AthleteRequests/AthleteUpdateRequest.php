<?php

namespace App\Http\Requests\AthleteRequests;

use Auth;
use App\Models\User;
use App\Validations\NameValidation;
use Illuminate\Foundation\Http\FormRequest;

class AthleteUpdateRequest extends FormRequest
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

        // Only admin can do this.
        return $user->is_admin
            || $user->hasPermission('delete_athletes');
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
