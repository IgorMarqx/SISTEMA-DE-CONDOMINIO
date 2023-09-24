<?php

namespace App\Repositories;

use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        try {
            return User::all();
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function storeUser($data): ApiResource
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'condominium_id' => $data['condominium_id'],
        ]);

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário criado com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findUserById($id): UserShowResource|ApiResource
    {
        $user = User::find($id);

        if (!$user) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new UserShowResource($user);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateUser($data, $id): ApiResource
    {
        $userUpdate = User::where('id', $id)->first();

        if (!$userUpdate) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        $userUpdate->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'updated_at' => date('Y-m-d H:i:s'),
            'condominium_id' => $data['condominium_id'],
        ]);

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário atualizado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function destroyUser($id): ApiResource
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return new ApiResource(['error' => false, 'message' => 'Usuário deletado com sucessp'], 200);
        }

        try {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }
}
