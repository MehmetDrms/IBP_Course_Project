<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function redirect(){
        if(Auth::check()) {
            if (Auth::user()->getRole->role == 'admin')
                return redirect()->route('admin.dashboard');
            elseif (Auth::user()->getRole->role == 'user')
                return redirect()->route('user.home');
        }
        else
            return view('home');
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password] )){
            return $this->redirect();
        }
        return view('home')->withErrors('E-posta veya parola hatalı!');
    }

    public function admin(){
        return view('admin.dashboard');
    }

    public function user(){
        return view('user.home');
    }
}
