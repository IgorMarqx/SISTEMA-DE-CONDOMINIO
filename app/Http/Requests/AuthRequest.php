<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:5'],
            'password_confirmation' => ['min:5'],
            'condominium_id' => ['required', 'numeric', 'condominium_exists'],
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first(),
        ]));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Preencha o campo nome.',

            'email.required' => 'Preencha o campo e-mail.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'E-mail já cadastrado.',

            'password.required' => 'Preencha o campo senha.',
            'password.confirmed' => 'A senhas não correspondem.',
            'password.min' => 'A senha tem que ter no minimo 5 caracteres.',

            'password_confirmation.min' => 'A confirmação tem que ter no minimo 5 caracteres.',

            'condominium_id.required' => 'Escolha um condominio.',
            'condominium_id.condominium_exists' => 'Condominio informado não existe.',

            'apartment_id.required' => 'Escolha um apartamento.',
            'apartment_id.apartment_exists' => 'Apartment informado não existe.',
        ];
    }
}
