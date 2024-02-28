<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashPage extends Controller
{
    public function admin(){
        $username = Auth::user()->username;
        return view('pages.admin.dashboard', compact('username'));
    }
    public function petugas(){
        $username = Auth::user()->username;

        return view('pages.petugas.dashboard',compact('username'));
    }
}
