<?php

namespace App\Repositories;

use App\Http\Resources\ApiResource;
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
        return User::all();
    }

    /**
     * @throws Exception
     */
    public function storeUser($data): ApiResource
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'condominium_id' => $data['condominium_id'],
        ]);

    }

    /**
     * @throws Exception
     */
    public function findUserById($id): User
    {
        return User::find($id);
    }

    /**
     * @throws Exception
     */
    public function updateUser($data, $id): bool
    {
        $user = User::find($id);

        return $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'updated_at' => date('Y-m-d H:i:s'),
            'condominium_id' => $data['condominium_id'],
        ], $id);
    }

    /**
     * @throws Exception
     */
    public function destroyUser($id): User
    {
        $user = User::find($id);

        return $user->delete();
    }
}
