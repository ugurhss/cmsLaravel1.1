<?php

namespace App\Http\Controllers\Pages;

class PagesController
{
    public function index(){
        return view('pages.dashboard');
    }
    public function intro(){
        return view('pages.intro');
    }
}
