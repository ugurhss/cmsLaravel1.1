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
        $request->merge([
            'name' => $request->input('name_surname'), // Frontend'den gelen "name_surname" alanını "name" olarak kabul ediyoruz
            'password_confirmation' => $request->input('password_rep'), // Şifre tekrarını Laravel'e uygun hale getiriyoruz
        ]);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:0,1',
        ];

        if ($request->user_id) {
            // Güncelleme
            if ($request->filled('password')) {
                $rules['password'] = 'required|confirmed|min:6';
            }
        } else {
            // Yeni kayıt
            $rules['password'] = 'required|confirmed|min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        $user = $request->user_id ? User::find($request->user_id) : new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->user_id) {
            $user->update_user_id = FacadesAuth::id();
            $user->updated_at = Carbon::now();
        } else {
            $user->create_user_id = FacadesAuth::id();
        }

        $user->save();

        return response()->json(['status' => true, 'message' => 'Kullanıcı başarıyla kaydedildi.']);
    }




}
