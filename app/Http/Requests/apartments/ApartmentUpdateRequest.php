<?php

namespace App\Http\Requests\apartments;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApartmentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identify' => ['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw  new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first()
        ], 402));
    }
}
