<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.users',compact('users'));
    }

    public function delete($id){
        $user=User::whereId($id)->delete();
        return $user
        ? back()->with('success','Kullanıcı Silindi')
        : back()->with('error','Kullanıcı Silinemedi');
    }
}
