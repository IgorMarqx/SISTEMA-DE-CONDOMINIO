<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $array = ['error' => ''];

        $teste = $request->input('email');

        $array['email'] = $teste;

        return $array;
    }
}
