<?php


namespace App\Http\Controllers;


use App\Admin;

class LoginController extends Controller
{
    public function login(){
        return view('login/login');
    }

    public function loginDo(){

        $info = request()->except('_token');

        $admin = Admin::where($info)->first();

        if($admin){
            session(['admin'=>$admin]);
            request()->session()->save();
            $data = session('admin');

            return redirect('/admin/index');
        }
        return redirect('/login')->with('msg', '用户名或密码错误');
    }

    public function test(){
        request()->session()->forget('admin');
    }
}
