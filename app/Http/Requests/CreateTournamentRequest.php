<?php

namespace App\Http\Requests;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class CreateTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validator = [];
        $pot = 0;
        $index = 0;
        foreach (range(0, 31) as $team) {
            if ($index % 8 == 0) {
                $pot++;
            }
            $validator["tournament.{$team}.pot"] = ['required', 'integer', "size:{$pot}"];

            $index++;
        }
        $validator['tournament.*.team'] = ['required', sprintf('exists:%s,id', Team::class)];

        return $validator;
    }
}
