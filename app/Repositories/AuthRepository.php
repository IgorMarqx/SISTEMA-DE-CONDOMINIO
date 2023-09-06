<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function getToken($data): object
    {
        $token = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if (!$token) {
            return response()->json(['error' => true, 'message' => 'E-mail ou senha inválidos!']);
        }

        return response()->json(['token' => $token]);
    }

    public function registerUser($data): object
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'condominium_id' => $data['condominium_id'],
            'apartment_id' => $data['apartment_id'],
        ]);

        if ($user) {
            return response()->json(['message' => 'Cadastrado com sucesso.']);
        }

        return response()->json(['error' => true]);
    }
}
