<?php

namespace App\Repositories\auth;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function getToken($data): string;

    public function registerUser($data): User;
}
