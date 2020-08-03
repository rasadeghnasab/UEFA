<?php

namespace App\Http\Requests\AthleteRequests;

use Auth;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AthleteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        $user = Auth::user() ?: new User;
        // TODO: we should add hasPermission to the system.
        return $user->hasPermission('add_sport');
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
            'superior_id' => ['users:id', 'superior_id is in sport_id', 'superior id must confirmed'],
            'sport_id' => ['exists in sports table'],
            'belt_id' => ['required', 'should exists in bels table', 'should belongs to the provided sport_id'],
        ];
    }
}
