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
    { $data = $request->all();
        $user_id = $data['user_id'] ?? null;

        $rules = [
            'name_surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:0,1',
        ];

        // Yeni kullanıcıysa şifre zorunlu
        if (!$user_id) {
            $rules['password'] = 'required|string|min:6|confirmed';
        } elseif ($request->filled('password')) {
            $rules['password'] = 'string|min:6|confirmed';
        }

        $validator = Validator::make($data, $rules, [
            'name_surname.required' => 'Ad Soyad alanı boş olamaz.',
            'email.required' => 'E-Mail alanı boş olamaz.',
            'email.email' => 'Geçerli bir e-mail giriniz.',
            'password.required' => 'Şifre alanı boş olamaz.',
            'password.confirmed' => 'Şifreler uyuşmuyor.',
            'status.required' => 'Durum seçilmelidir.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        // E-posta daha önce alınmış mı kontrolü (yeni kullanıcıysa)
        if (!$user_id && User::where('email', $data['email'])->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Bu e-mail adresi ile daha önce kayıt yapılmış.'
            ]);
        }

        $user = $user_id ? User::find($user_id) : new User();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Kullanıcı bulunamadı.'
            ]);
        }

        $user->name = $data['name_surname'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->status = $data['status'];

        if (!$user_id) {
            $user->create_user_id = Auth::id();
            $user->password = Hash::make($data['password']);
        } else {
            $user->update_user_id = Auth::id();
            $user->updated_at = Carbon::now();

            if ($request->filled('password')) {
                $user->password = Hash::make($data['password']);
            }
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => $user_id ? 'Kullanıcı başarıyla güncellendi.' : 'Kullanıcı başarıyla oluşturuldu.'
        ]);
    }


}
