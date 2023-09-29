<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function getToken($data): string;
    public function registerUser($data): User;
}
