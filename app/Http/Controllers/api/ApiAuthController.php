<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request): object
    {
        $array = ['error' => ''];

        $credentials = $request->only(['email', 'password']);

        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return response()->json($array);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $token = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);

        if (!$token) {
            return response()->json(['error' => true, 'message' => 'E-mail ou senha inválidos!']);
        }

        $array['token'] = $token;

        return response()->json($array);
    }

    public function register(Request $request): object
    {
        $array = ['error' => ''];

        $credentials = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator = Validator::make($credentials, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required_with:password_confirmation', 'same:password_confirmation', 'min:5', 'confirmed'],
            'password_confirmation' => ['min:5'],
        ]);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return response()->json($array);
        }

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
        $user->save();

        if ($user) {
            $array['message'] = 'Cadastrado com sucesso!';
            return response()->json($array);
        }

        return response()->json($array);
    }

    public function validator($data): object
    {
        return $validator = Validator::make($data, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);
    }
}
