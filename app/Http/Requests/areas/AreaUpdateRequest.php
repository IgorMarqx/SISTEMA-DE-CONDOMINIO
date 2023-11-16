<?php

namespace App\Http\Requests\areas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AreaUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'days' => ['required', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'end_time' => ['required', 'date_format:H:i:s'],
            'allowed' => ['required', 'numeric'],
            'condominium_id' => ['required', 'numeric', 'condominium_exists'],
        ];
    }

    public function failedValidation(Validator $validator): object
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first(),
        ]));
    }
}
