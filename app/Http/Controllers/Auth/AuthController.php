<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login(){

        // dd(Hash::make('12345'));
        return view('auth.login');
    }
}
