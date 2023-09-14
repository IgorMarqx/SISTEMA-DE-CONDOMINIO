<?php

namespace App\Http\Requests\areas;

use App\Rules\CondominiumExistRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AreaCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'days' => ['required', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'end_time' => ['required', 'date_format:H:i:s'],
            'condominium_id' => ['required', 'numeric', new CondominiumExistRule($this->input('condominium_id'))],
        ];
    }

    public function failedValidation(Validator $validator): object
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first()
        ]));
    }
}
