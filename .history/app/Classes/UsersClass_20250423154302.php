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
        $validated = $request->validate([
            'name_surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
            'password' => $request->user_id ? 'nullable|confirmed|min:6' : 'required|confirmed|min:6',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:0,1',
        ]);

        $user = $request->user_id ? User::findOrFail($request->user_id) : new User();
        $user->name = $validated['name_surname'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->status = $validated['status'];
        $user->password = $validated['password'] ? Hash::make($validated['password']) : $user->password;

        $user->{$request->user_id ? 'update_user_id' : 'create_user_id'} = Auth::id();
        $user->save();

        return response()->json([
            'status' => true,
            'message' => $request->user_id ? 'Kullanıcı güncellendi.' : 'Kullanıcı oluşturuldu.'
        ]);
    }


}
