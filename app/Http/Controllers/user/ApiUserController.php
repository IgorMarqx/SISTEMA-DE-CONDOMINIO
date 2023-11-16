<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Services\user\UserService;
use Exception;

class ApiUserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('api.auth');
    }

    /**
     * @throws \Exception
     */
    public function index(): \Illuminate\Support\Collection
    {
        return $this->userService->getAll();
    }

    /**
     * Display the specified resource.
     *
     * @throws Exception
     */
    public function show(string $id): ApiResource|UserShowResource
    {
        $user = $this->userService->findUserById($id);

        if ($user['error']) {
            return new ApiResource($user, 404);
        }

        try {
            return new UserShowResource($user);
        } catch (Exception $e) {
            throw new Exception('Erro: '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update(UserRequest $request, string $id): ApiResource
    {
        $user = $this->userService->updateUser($request, $id);

        if (! $user) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário atualizado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Exception
     */
    public function destroy(string $id): ApiResource
    {
        $user = $this->userService->destroyUser($id);

        if (! $user) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário deletado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro: '.$e->getMessage());
        }
    }
}
