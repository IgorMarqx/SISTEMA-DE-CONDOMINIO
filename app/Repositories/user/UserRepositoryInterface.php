<?php

namespace App\Repositories\user;

use App\Http\Resources\ApiResource;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;

    public function storeUser($data): ApiResource;

    public function findUserById($id): User|null|Collection;

    public function updateUser(User $user, $data): User|bool|null;

    public function destroyUser(User $user): User|null|bool;

    public function filterUser($data): LengthAwarePaginator;
}
