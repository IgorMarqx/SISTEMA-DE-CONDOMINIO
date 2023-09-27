<?php

namespace App\Services\user;

use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function getALl(): Collection
    {
        try {
            return $this->userRepository->getAll();
        } catch (Exception $e) {
            throw new Exception("Erro: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function storeUser($data): ApiResource
    {
        $this->userRepository->storeUser($data);

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário criado com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findUserById($id): UserShowResource|ApiResource
    {
        $user = $this->userRepository->findUserById($id);

        if (!$user) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new UserShowResource($user);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateUser($data, $id): ApiResource
    {
        $userUpdate = $this->userRepository->updateUser($data, $id);

        if (!$userUpdate) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário atualizado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function destroyUser($id): ApiResource
    {
        $user = $this->userRepository->destroyUser($id);

        if (!$user) {
            return new ApiResource(['error' => true, 'message' => 'Usuário não encontrado'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Usuário deletado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }
}
