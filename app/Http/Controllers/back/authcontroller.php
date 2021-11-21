<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class authcontroller extends Controller
{
    public function login(){
        return view('back.auth.login');
    }
    public function loginPost(Request $request){
        if(Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password,
        ])){
            return redirect()->route('admin.dashboard');
        }
        else{
            return redirect()->route('admin.login')->withErrors('Mailiniz veya şifreniz yanlış.');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
