<?php

namespace App\Services\auth;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthService
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function getToken($data): null|string
    {
        return $this->authRepository->getToken($data);
    }

    public function registerUser($data): User
    {
        return $this->authRepository->registerUser($data);
    }
}
