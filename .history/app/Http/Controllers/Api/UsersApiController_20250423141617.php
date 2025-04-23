<?php

namespace App\Http\Controllers\Api;

use App\Classes\LoginClass;
use App\Classes\UsersClass;

class UsersApiController
{
    public function index()
    {
        $users = new UsersClass();
        return $users->index();
    }
   public function create()
   {
      $login = new UsersClass();
      $login->createUser();
   }

}
