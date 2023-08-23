<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        dd('teste');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
