<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Container\Attributes\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UsersClass
{



    public function index()
    {
        $users = User::select(['id', 'name', 'email', 'phone', 'updated_at']);//burada veri tabanından gerekli olanları cekiyoruz

        return datatables()->of($users)// datatables kütüphanesi ile verileri çekiyoruz
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<a href="/users/edit/'.$user->id.'" class="btn btn-sm btn-primary">Düzenle</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    public function createUser(Request $request)
    {

    }




}
