<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(User $user): object
    {
        $array = ['error' => ''];

        if ($user) {
            $array['users'] = $this->userRepository->allUsers();
            return response()->json(['users' => $array]);
        }

        return response()->json(['error' => 'true'], 204);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        $array = ['error' => ''];

        $user = $this->userRepository->findUserById($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não encontrado';
            return response()->json($array);
        }

        return response()->json($user);
    }


    public function edit(string $id): object
    {
        $array = ['error' => ''];

        $user = $this->userRepository->findUserById($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não encontrado.';
            return response()->json($array);
        }

        return response()->json($user);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): object
    {
        $array = ['error' => ''];

        $user = $this->userRepository->findUserById($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não existe.';
            return response()->json($array);
        }

        $credentials = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return response()->json($array);
        }

        $this->userRepository->updateUser($credentials, $id);

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

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não encontrado.';
            return response()->json($array);
        }

       $this->userRepository->destroyUser($id);
        $array['message'] = 'Usuário deletado com sucesso.';

        return response()->json($array);
    }

    public function validator($data): object
    {
        return $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required_with:password_confirmation', 'same:password_confirmation', 'min:5', 'confirmed'],
            'password_confirmation' => ['min:5'],
        ]);
    }
}
