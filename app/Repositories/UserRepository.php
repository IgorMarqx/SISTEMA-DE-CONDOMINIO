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
    public function findUserById($id): User|null|Collection
    {
        return User::find($id);
    }

    /**
     * @throws Exception
     */
    public function updateUser(User $user,$data): User|bool|null
    {
       return $user->update($data);
    }

    /**
     * @throws Exception
     */
    public function destroyUser(User $user): User|bool|null
    {
        return $user->delete();
    }
}
