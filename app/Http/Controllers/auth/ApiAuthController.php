<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\auth\TokenResource;
use App\Services\auth\AuthService;
use Exception;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws Exception
     */
    public function login(Request $request): ApiResource|TokenResource
    {
        $token = $this->authService->getToken($request);

        if (empty($token)) {
            return new ApiResource(['error' => true, 'message' => 'E-mail ou senha inválidos!'], 401);
        }

        try {
            return new TokenResource($token, 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao gerar token: ', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function register(AuthRequest $request): ApiResource
    {
        $this->authService->registerUser($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Cadastrado com sucesso.'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar usuário: ', $e->getMessage());
        }

    }
}
