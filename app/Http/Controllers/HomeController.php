<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function adminPage(){
        $user = auth()->user();
        return view('Admin.dist.creative.home',[
            'title'=>'Trang Chủ'
        ],compact('user'));
    }
}
