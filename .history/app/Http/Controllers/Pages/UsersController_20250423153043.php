<?php

namespace App\Http\Controllers\Pages;

class UsersController
{

    public function index()  {
        return view('pages.users.index');
    }

    public function create()  {
        return view('pages.users.create');
    }
}
