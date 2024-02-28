<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Login extends Controller
{
    function index(){
        return view('pages.login');
    }

    function login(Request $request){
        $request->validate(
        [    'username'=> 'required',
            'password'=>'required'
        ],
        [
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi'
        ]
        );

        $DataLogin = [
            'username'=> $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($DataLogin)) {
            if (Auth::user()->role == 'admin') {
                return Redirect('/admin/dashboard');
            } elseif(Auth::user()->role == 'petugas') {
                return redirect('/petugas');
            }


        }else{
            $validate =[ 'salah'=> 'Daata yang dimasukan salah'];
            return redirect('/')->withErrors($validate)->withInput();
        }

    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
