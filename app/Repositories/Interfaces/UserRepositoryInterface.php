<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function allUsers();
    public function storeUser($user);
    public function findUserById($id);
    public function updateUser($user, $id);
    public function destroyUser($id);
}
