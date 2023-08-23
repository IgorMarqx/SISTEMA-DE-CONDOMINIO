<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{

    public function index(User $user): array
    {
        $array = ['error' => ''];

        if ($user) {
            $array['users'] = $user->get(['id', 'name', 'email', 'created_at', 'updated_at']);
        }

        return $array;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $array = ['error' => ''];

        $user = User::find($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não encontrado.';
            return $array;
        }

        return response()->json($user);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $array = ['error' => ''];

        $user = User::find($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não existe.';
            return $array;
        }

        $credentials = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return $array;
        }

        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];
        $user->touch();
        $user->save();

        $array['message'] = 'Usuário editado com sucesso.';

        return $array;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $array = ['error' => ''];

        $user = User::find($id);

        if (!$user) {
            $array['error'] = true;
            $array['message'] = 'Usuário não encontrado.';
            return $array;
        }

        $user->delete();
        $array['message'] = 'Usuário deletado com sucesso.';

        return $array;
    }

    public function validator($data)
    {
        return $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required_with:password_confirmation', 'same:password_confirmation', 'min:5', 'confirmed'],
            'password_confirmation' => ['min:5'],
        ]);
    }
}
