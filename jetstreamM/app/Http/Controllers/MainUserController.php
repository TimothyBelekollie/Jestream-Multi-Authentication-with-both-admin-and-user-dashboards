<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainUserController extends Controller
{
    //
    public function Register(){
        return view('user.register');
    }
    public function Login(){
        return view('user.login');
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
}
