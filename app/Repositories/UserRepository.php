<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): object
    {
        return User::all();
    }

    public function storeUser($user): void
    {
        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'condominium_id' => $user['condominium_id'],
            'apartment_id' => $user['apartment_id'],
        ]);
        $user->save();
    }

    public function findUserById($id): object
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Usuário não encontrado']);
        }
        return $user;
    }

    public function updateUser($user, $id): void
    {
        $userUpdate = User::where('id', $id)->first();
        $userUpdate->name = $user['name'];
        $userUpdate->email = $user['email'];
        $userUpdate->password = Hash::make($user['password']);
        $userUpdate->save();
    }

    public function destroyUser($id): void
    {
        $user = User::find($id);
        $user->delete();
    }
}
