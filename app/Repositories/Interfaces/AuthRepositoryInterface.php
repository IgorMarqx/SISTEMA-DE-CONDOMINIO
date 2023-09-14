<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\auth\TokenResource;

interface AuthRepositoryInterface
{
    public function getToken($data): ApiResource|TokenResource;
    public function registerUser($data): ApiResource;
}
