<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create(): View{
        //vista register
    }


    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            
        }
    }
}
