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
            'condominium_id' => 'required',
            'operations_id' => 'required'
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
