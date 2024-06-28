<?php

namespace App\Http\Requests;

use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MatchupStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'championship_id' => [

                'required',
                'numeric',
                Rule::in(Championship::all()->pluck('id'))
            ],

            'team_1_id' => [

                'required',
                'numeric',
                Rule::in(Team::all()->pluck('id'))
            ],

            'team_2_id' => [

                'required',
                'numeric',
                Rule::in(Team::all()->pluck('id'))
            ],

            'team_1_goals'  => 'numeric',
            'team_2_goals'  => 'numeric',
            'phase'         => 'required|numeric'
        ];
    }
}
