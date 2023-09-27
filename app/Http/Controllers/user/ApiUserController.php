<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Http\Resources\user\UserShowResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Services\user\UserService;
use Illuminate\Database\Eloquent\Collection;

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
    public function index(): Collection
    {
        return $this->userService->getAll();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ApiResource|UserShowResource
    {
        return $this->userService->findUserById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id): ApiResource
    {
        return $this->userService->updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        return $this->userService->destroyUser($id);
    }
}
