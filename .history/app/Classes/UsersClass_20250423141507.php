<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class UsersClass
{
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
