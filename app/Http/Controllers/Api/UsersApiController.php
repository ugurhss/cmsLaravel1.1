<?php

namespace App\Http\Controllers\Api;

use App\Classes\LoginClass;
use App\Classes\UsersClass;

class UsersApiController
{
    public function index()
    {
        $users = new UsersClass();
        return ($users->index());
    }
   public function create()
   {
      $usercreate = new UsersClass();

    return response()->json($usercreate->createUser(request()));
    }

}
