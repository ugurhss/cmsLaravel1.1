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
        try {
            $name_surname = $request->get('name_surname');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $password = $request->get('password');
            $password_rep = $request->get('password_rep');
            $status = $request->get('status');
            $user_id = $request->get('user_id');

            if ($name_surname == null) {
                return ["status" => false, "message" => "Ad Soyad alanı boş olamaz."];
            }

            if ($email == null) {
                return ["status" => false, "message" => "E-Mail alanı boş olamaz."];
            }

            if ($user_id == null) {
                // Yeni kullanıcı oluşturuluyor
                $mailCheck = User::where('email', $email)->first();
                if ($mailCheck) {
                    return ["status" => false, "message" => "Bu e-mail adresi ile daha önce kayıt yapılmış."];
                }

                if ($password == null) {
                    return ["status" => false, "message" => "Şifre alanı boş olamaz."];
                }

                if ($password_rep == null) {
                    return ["status" => false, "message" => "Şifre tekrar alanı boş olamaz."];
                }

                if ($password != $password_rep) {
                    return ["status" => false, "message" => "Şifreler uyuşmuyor."];
                }

                $user = new User();
                $user->create_user_id = FacadesAuth::user()->id;
                $user->password = Hash::make($password);
            } else {
                // Var olan kullanıcı güncelleniyor
                $user = User::find($user_id);
                if (!$user) {
                    return ["status" => false, "message" => "Kullanıcı bulunamadı."];
                }

                $user->update_user_id = FacadesAuth::user()->id;
                $user->updated_at = Carbon::now();

                if ($password != null) {
                    if ($password_rep == null) {
                        return ["status" => false, "message" => "Şifre tekrar alanı boş olamaz."];
                    }

                    if ($password != $password_rep) {
                        return ["status" => false, "message" => "Şifreler uyuşmuyor."];
                    }

                    $user->password = Hash::make($password);
                }
            }

            // Ortak alanlar (create ve update için geçerli)
            $user->name = $name_surname;
            $user->email = $email;
            $user->phone = $phone;
            $user->status = $status;

            if ($user->save()) {
                return [
                    "status" => true,
                    "message" => "Kullanıcı kaydı başarıyla " . ($user_id == null ? 'gerçekleşti' : 'güncellendi') . "."
                ];
            } else {
                return ["status" => false, "message" => "Kullanıcı kaydı sırasında bir hata oluştu."];
            }
        } catch (\Throwable $th) {
            return [
                "status" => false,
                "message" => "Kullanıcı kaydı sırasında bir hata oluştu.",
                "error" => $th->getMessage(), // geçici debug
                "line" => $th->getLine()
            ];
        }

    }





}
