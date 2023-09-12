<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAll(): object;
    public function storeUser($user): void;
    public function findUserById($id);
    public function updateUser($user, $id): void;
    public function destroyUser($id): void;
}
