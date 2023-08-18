<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4']
        ]);

        if ($validator->fails()) {
            $array['error'] = true;
            $array['message'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }
}
