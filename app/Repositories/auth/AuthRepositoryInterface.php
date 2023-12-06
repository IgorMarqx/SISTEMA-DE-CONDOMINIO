<?php

namespace App\Repositories\auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AuthRepositoryInterface
{
    public function getToken($data): string|null;
    public function registerUser($data): User;
    public function verifyToken($data): Collection;
}
