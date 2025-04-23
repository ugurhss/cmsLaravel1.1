<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class UsersClass
{



    public function index()
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
        return datatables()->of($users)
            ->addColumn('action', function ($user) {
                return '<a href="/users/edit/'.$user->id.'" class="btn btn-sm btn-primary">Düzenle</a>';
            })
            ->make(true);
    }
   public function createUser()
   {
      $user = new User();
      $user->name = request('name');
      $user->email = request('email');
      $user->password = Hash::make(request('password'));
      $user->save();

      return redirect()->route('users')->with('success', 'User created successfully');
   }

}
