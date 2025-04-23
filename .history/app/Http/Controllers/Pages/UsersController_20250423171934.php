<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;

class UsersController
{

    public function index()  {
        return view('pages.users.index');
    }

    public function create()  {
     return view('pages.users.create', ['user' => null]);
    }

    public function edit($id)  {
        $user = User::where('id', $id)->first();
        if($user == null){
            return redirect()->route('users');
        }

        view()->share('user', $user);

        return view('pages.users.create', ['user' => $user]);
    }
}
