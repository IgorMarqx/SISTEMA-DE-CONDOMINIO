<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserRequest;

class ApiUserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('api.auth');
    }

    public function index(User $user): object
    {
        $array = ['error' => ''];

        if ($user) {
            $array = $this->userRepository->allUsers();
            return response()->json($array);
        }

        return response()->json(['error' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        $user = $this->userRepository->findUserById($id);

        return response()->json(['error' => '', 'message' => $user]);
    }


    public function edit(string $id): object
    {
        $user = $this->userRepository->findUserById($id);

        return response()->json($user);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id): object
    {
        $array = ['error' => ''];

        $user = $this->userRepository->findUserById($id);
        $userDecode = json_decode($user, true);

        if (!$userDecode) {
            return response()->json($user);
        }

        $this->userRepository->updateUser($request, $id);

        $array['message'] = 'Usuário editado com sucesso.';

        return response()->json($array);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        $array = ['error' => ''];

        $user = $this->userRepository->findUserById($id);
        $userDecode = json_decode($user, true);

        if (!$userDecode) {
            return response()->json($user);
        }

        $this->userRepository->destroyUser($id);
        $array['message'] = 'Usuário deletado com sucesso.';

        return response()->json($array);
    }
}
