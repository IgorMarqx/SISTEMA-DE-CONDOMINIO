<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request): object
    {
        $token = $this->authRepository->getToken($request);

        return response()->json($token);
    }

    public function register(UserRequest $request): object
    {
        $user = $this->authRepository->registerUser($request);

        if (!$user) {
            return response()->json($user);
        }

        return response()->json($user);
    }
}
