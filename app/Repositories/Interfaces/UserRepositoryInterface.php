<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;

    public function storeUser($data): ApiResource;

    public function findUserById($id): User|null|Collection;

    public function updateUser(User $user, $data): User|bool|null;

    public function destroyUser(User $user): User|null|bool;
}
