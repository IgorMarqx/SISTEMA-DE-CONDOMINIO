<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers(): object
    {
        return User::all();
    }

    public function storeUser($user): object
    {
        return User::create($user);
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
