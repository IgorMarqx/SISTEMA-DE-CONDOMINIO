<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request): array
    {
        $array = ['error' => ''];

        $credentials = $request->only(['email', 'password']);

        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return $array;
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $token = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);

        if (!$token) {
            $array['error'] = 'E-mail ou senha inválido.';
            return $array;
        }

        $array['token'] = $token;

        return $array;
    }

    public function register(Request $request): array
    {
        $array = ['error' => ''];

        $credentials = $request->only(['email', 'password']);

        $validator = $this->validator($credentials);

        return $array;
    }

    public function validator($data)
    {
        return $validator = Validator::make($data, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);
    }
}
