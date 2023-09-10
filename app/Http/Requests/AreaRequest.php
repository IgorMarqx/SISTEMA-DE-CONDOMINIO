<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AreaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'days' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'condominium_id' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first()
        ]));
    }
}
