<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function getToken($data): object;
    public function registerUser($data): object;
}
