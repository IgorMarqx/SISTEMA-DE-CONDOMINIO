<?php

namespace App\Http\Requests\condominiums;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CondominiumRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:condominiums'],
            'address' => ['required', 'unique:condominiums']
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
