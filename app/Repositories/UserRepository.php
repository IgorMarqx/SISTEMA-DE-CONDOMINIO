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
        return User::find($id);
    }

    public function updateUser($user, $id): void
    {
        $user = User::where('id', $id)->first();
        $user->name = $user['name'];
        $user->email = $user['email'];
        $user->password = Hash::make($user['password']);
        $user->save();
    }

    public function destroyUser($id):void
    {
        $user = User::find($id);
        $user->delete();
    }
}
