<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){

        if(Auth::attempt(['name'=>$request->username,'password'=>$request->password ])){
           return redirect()->route('get.admin-demands');
        }
        return back()->with('error','Kullanıcı Adı veya Şifre Hatalı');
    }


    public function register(Request $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $user
        ? back()->with('success','Kullanıcı Eklendi')
        : back()->with('error','Kullanıcı Eklenemedi');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('get.login')->with('info','Çıkış Yapıldı');
    }
}
