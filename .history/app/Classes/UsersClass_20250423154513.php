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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['success' => true, 'message' => 'Kullanıcı başarıyla oluşturuldu.']);



   }



}
