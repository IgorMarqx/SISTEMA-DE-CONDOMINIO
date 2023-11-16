<?php

namespace App\Services\user;

use App\Http\Requests\UserRequest;
use App\Http\Resources\ApiResource;
use App\Models\User;
use App\Repositories\user\UserRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
            throw new Exception('Erro: '.$e->getMessage());
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
            throw new Exception('Erro: '.$e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findUserById($id): array|Collection|User
    {
        $user = $this->userRepository->findUserById($id);

        if ($user) {
            return $user;
        }

        return ['error' => true, 'message' => 'Usuário não encontrado'];
    }

    /**
     * @throws Exception
     */
    public function updateUser(UserRequest $data, $id): User|null|bool
    {
        $user = $this->userRepository->findUserById($id);

        if ($user) {
            return $this->userRepository->updateUser($user, [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'condominium_id' => $data->condominium_id,
            ]);
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function destroyUser($id): User|null|bool
    {
        $user = $this->userRepository->findUserById($id);

        if (! $user) {
            return null;
        }

        return $this->userRepository->destroyUser($user);
    }

    public function filterUser($user): ?LengthAwarePaginator
    {
        $filter = $this->userRepository->filterUser($user);

        if ($filter->isEmpty()) {
            return null;
        }

        return $filter;
    }
}
