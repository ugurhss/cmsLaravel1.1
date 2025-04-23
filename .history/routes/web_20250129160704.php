<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
   if(Auth::check()){
       return redirect()->route('dashboard');
   }else{
       return redirect()->route('login');
   }
});

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/api/login',[AuthApiController::class,'login']);

Route::get('/dashboard',[PagesController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('/users',[UsersController::class,'index'])->name('users')->middleware('auth');