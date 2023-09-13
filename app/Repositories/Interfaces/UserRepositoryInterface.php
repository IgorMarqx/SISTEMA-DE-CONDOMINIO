<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;
    public function storeUser($data): ApiResource;
    public function findUserById($id): ApiResource|UserShowResource;
    public function updateUser($data, $id): ApiResource;
    public function destroyUser($id): ApiResource;
}
