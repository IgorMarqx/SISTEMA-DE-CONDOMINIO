<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation|min:5',
            'password_confirmation' => 'min:5',
        ];
    }

    public function failedValidation(Validator $validator): object
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]));
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Preencha o campo nome.',
            'email.required' => 'Preencha o campo e-mail.',
            'email.email' => 'E-mail inválido.',
            'password.required' => 'Preencha o campo senha.',
            'password.same' => 'A senhas não correspondem.',
            'password.min' => 'A senha tem que ter no minimo 5 caracteres.',
            'password_confirmation.min' => 'A confirmação tem que ter no minimo 5 caracteres.',
        ];
    }
