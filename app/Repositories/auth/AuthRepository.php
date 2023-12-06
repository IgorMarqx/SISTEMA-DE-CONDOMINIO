<?php

namespace App\Repositories\auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function getToken($data): string|null
    {
        $token = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if(!$token){
            return null;
        }

        \auth()->user()->update([
            'token' => $token,
        ]);

        return $token;
    }

    public function registerUser($data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'condominium_id' => $data['condominium_id'],
        ]);
    }

    public function verifyToken($data): Collection
    {
        return User::where('token', $data['token'])->get();
    }
}
