<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\UsersController;
use App\Http\Controllers\Api\UsersApiController;


Route::get('/intro', [PagesController::class, 'intro'])->name('intro');


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
Route::get('/users',[UsersController::class,'index'])->name('userslist')->middleware('auth');

Route::get('/api/users',[UsersApiController::class,'index'])->name('users')->middleware('auth');

Route::get('/users/create',[UsersController::class,'create'])->name('userscreate')->middleware('auth');
Route::post('/api/users/createUser', [UsersApiController::class, 'create'])->middleware('auth');

Route::get('/users/edit/{id}',[UsersController::class,'edit'])->name('useredit')->middleware('auth');
Route::get('/users/delete/{id}', [UsersApiController::class, 'delete'])->name('userdelete');


Route::get('blog',[BlogController::class,'index'])->name('blog')->middleware('auth');
