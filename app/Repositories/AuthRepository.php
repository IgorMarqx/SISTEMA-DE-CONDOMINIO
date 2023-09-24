<?php

namespace App\Repositories;

use App\Http\Resources\ApiResource;
use App\Http\Resources\auth\TokenResource;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getToken($data): ApiResource|TokenResource
    {
        $token = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if (!$token) {
            return new ApiResource(['error' => true, 'message' => 'E-mail ou senha inválidos!'], 401);
        }

        try {
            return new TokenResource($token, 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao gerar usuário: ', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function registerUser($data): ApiResource
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'condominium_id' => $data['condominium_id'],
        ]);

        try {
            return new ApiResource(['error' => false, 'message' => 'Cadastrado com sucesso.'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar usuário: ', $e->getMessage());
        }

    }
}
