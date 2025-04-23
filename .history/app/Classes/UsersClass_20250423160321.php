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
            $data = $request->only([
                'name_surname', 'email', 'phone', 'password', 'password_rep', 'status', 'user_id'
            ]);

            $validator = Validator::make($data, [
                'name_surname' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => $data['user_id'] ? 'nullable|min:6' : 'required|min:6',
                'password_rep' => $data['password'] ? 'required|same:password' : 'nullable',
                'status' => 'required|in:0,1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            if (!$data['user_id']) {
                if (User::where('email', $data['email'])->exists()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Bu e-mail adresi ile daha önce kayıt yapılmış.'
                    ]);
                }

                $user = new User();
                $user->create_user_id = auth()->id();
                $user->password = Hash::make($data['password']);
            } else {
                $user = User::findOrFail($data['user_id']);
                $user->update_user_id = auth()->id();
                $user->updated_at = now();

                if (!empty($data['password'])) {
                    $user->password = Hash::make($data['password']);
                }
            }

            $user->name = $data['name_surname'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->status = $data['status'];

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Kullanıcı kaydı başarıyla ' . ($data['user_id'] ? 'güncellendi' : 'oluşturuldu') . '.'
            ]);

        } catch (\Throwable $e) {
            // Log hatası isterseniz buraya log ekleyebilirsiniz
            return response()->json([
                'status' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }




}
