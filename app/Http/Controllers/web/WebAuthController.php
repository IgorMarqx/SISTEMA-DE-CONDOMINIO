<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        dd('testree');
    }
}
