<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\If_;

class SessionController extends Controller
{
    function index()
    {
        return view("sesi/index");
    }

    function login(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
            # code...
            return redirect('/')->with('success', 'Berhasil login!');
        } else {
            # code...
            return redirect('sesi')->withErrors('Username dan Password salah');
        }
        
    }

    function logout(){
        Auth::logout();
        return redirect('sesi')->with('success', 'Berhasil Logout!');

    }

    function create(Request $request){
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        
        User::create($data);
    
        return redirect('sesi')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    

    function register(){
        return view('sesi/register');
    }

}
