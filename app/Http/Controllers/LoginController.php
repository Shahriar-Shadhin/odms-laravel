<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;


class LoginController extends Controller
{
    public function index(){
        return \view('index');
    }

    public function login(Request $req){
       $credentials = $req->only('username', 'password');
       $this->validate($req, [
           'username' => 'required',
           'password' => 'required'
       ]);
    
       if(auth()->attempt($credentials)){
            if (auth()->user()->role === 'admin') {
                session(['id' => auth()->user()->username]);
                return redirect()->route('admin.main', session('id'));
            
            }elseif(auth()->user()->role === 'student'){
                session(['id' => auth()->user()->username]);
                return redirect()->route('student.main', session('id'));
            
            }elseif(auth()->user()->role === 'teacher'){
                session(['id' => auth()->user()->username]);
                return redirect()->route('teacher.main', session('id'));
            }

       }else{
           return \redirect()->back()->withErrors(['Invalid Login Credentials!']);
       }

    
    }

    public function logout(Request $request){
    
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return \redirect()->route('loginForm');
    }

    
}
