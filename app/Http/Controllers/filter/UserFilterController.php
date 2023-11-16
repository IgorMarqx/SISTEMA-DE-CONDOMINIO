<?php

namespace App\Http\Controllers\filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\filters\user\UserFilterRequest;
use App\Http\Resources\ApiResource;
use App\Services\user\UserService;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFilterController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function filterUser(UserFilterRequest $user): LengthAwarePaginator|ApiResource
    {
        $filter = $this->userService->filterUser($user);

        if (! $filter) {
            return new ApiResource(['error' => true, 'message' => 'Nenhum usuário encontrado'], 404);
        }

        return $filter;
    }
}
