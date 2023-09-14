<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\auth\TokenResource;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request): ApiResource|TokenResource
    {
        return $this->authRepository->getToken($request);
    }

    public function register(AuthRequest $request): ApiResource
    {
        return $this->authRepository->registerUser($request);
    }
}
