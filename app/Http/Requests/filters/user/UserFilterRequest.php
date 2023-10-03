<?php

namespace App\Http\Requests\filters\user;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UserFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userFilter' => ['required']
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'userFilter' => 'empty',
            'message' => $validator->errors()->first()
        ]));
    }

    public function messages()
    {
        return [
            'userFilter.required' => 'Informe alguma coisa no filtro para a pesquisa ser feita.'
        ];
    }
}
