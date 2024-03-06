<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Employee;
use App\Models\Pelanggan;
use App\Models\Subtransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashPage extends Controller
{
    public function getDataDash(){
        $Jproduk = Product::count();
        $Jpasien = Pelanggan::count();
        $Jkaryawan = Employee::count();
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        
        // Get the previous month and year
        $previousMonth = $now->subMonth()->month;
        $previousYear = $now->year;
        $Jpembeli = Transaction::whereMonth('transactionDate', $previousMonth)
        ->whereYear('transactionDate', $previousYear)
        ->count();

        $jumlahPenjualan = Subtransaction::whereHas('transaction', function ($query) use ($currentMonth) {
            $query->whereMonth('transactionDate', $currentMonth);
        })->sum('quantity');


        return response()->json(['jp'=>$Jproduk, 'jpa'=>$Jpasien,'jk'=>$Jkaryawan, 'jpe'=>$Jpembeli, 'jpt'=>$jumlahPenjualan]);
    }
    public function getDataTP(){
        $data = Transaction::selectRaw('MONTH(transactionDate) as month, SUM(totalPrice) as total')
            ->groupBy('month')
            ->orderBy('month') 
            ->get();
    
        return response()->json($data);
    }

public function dataTransDash(){
    $data = Transaction::orderBy('transactionDate', 'desc')->take(5)->get();
    return response()->json(['data'=>$data]);
}
    
    public function admin(){
        $username = Auth::user()->username;
        return view('pages.admin.dashboard', compact('username'));
    }
    public function petugas(){
        $username = Auth::user()->username;

        return view('pages.petugas.dashboard',compact('username'));
    }
}
