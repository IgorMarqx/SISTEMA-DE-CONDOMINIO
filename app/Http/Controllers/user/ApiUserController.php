<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Collection;

class ApiUserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('api.auth');
    }

    public function index(): Collection
    {
        return $this->userRepository->getAll();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ApiResource|UserShowResource
    {
        return $this->userRepository->findUserById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id): ApiResource
    {
        return $this->userRepository->updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        return $this->userRepository->destroyUser($id);
    }
}
