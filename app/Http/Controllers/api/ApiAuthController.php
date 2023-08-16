<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\AuthApiRequest;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login(AuthApiRequest $request)
    {
        $array = ['error' => ''];

        $validate = $request->validate();
        $validate = $request->safe()->only(['email', 'password']);

        $array['email'] = $validate;

        return $array;
    }
}
