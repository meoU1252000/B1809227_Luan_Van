<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthController extends Controller
{
    //
    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function index()
    {
        //
        // Hacker1252000!
        return view('Admin.dist.creative.login', [
            'title' => 'Trang Đăng Nhập'
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter|max:255|ends_with:gmail.com',
            'password' => 'required|max:255|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ],  $request->input('remember'))) {
            return redirect()->route('admin.index');
        };
        Session::flash('error',  'Email hoặc Password không chính xác');
        return redirect()->back();
        // return response()->json(['code' => 200, 'data' => "Email hoặc Mật Khẩu không chính xác"]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $user = $this->authRepo->create($data);
        return redirect()->route('staff.account');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
