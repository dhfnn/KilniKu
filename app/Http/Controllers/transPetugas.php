<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Subtransaction;


class transPetugas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$pelanggan = Pelanggan::all();
$produk = Product::all();
$checkup = Checkup::all();
$user = Auth()->user();
$role = Auth()->user()->role;
return view('pages.petugas.transaksi', compact('pelanggan', 'user', 'produk','checkup','role'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $todayDate = now()->toDateString();
        $data = [
            'transactionDate' => $todayDate,
            'customerID' => $request->customerID,
            'userID' => $userId,
            'totalPrice' => $request->hargaKeseluruhan,
            'checkupID' => $request->checkupID
        ];
        $trans = Transaction::create($data);
        $transID = $trans->transactionID;
        $quantity = $request->jumlah;
        $productId = $request->productId;

        for ($i = 0; $i < count($quantity); $i++) {
            $data2 = [
                'transID' => $transID,
                'productID' => $productId[$i],
                'quantity' => $quantity[$i],
                'subTotal' => $request->subTotal
            ];
            Subtransaction::create($data2);

            $product = Product::where('productID', $productId[$i])->first();
            $currentStock = $product->stock;
            $quantityBought = $quantity[$i];
            $remainingStock = $currentStock - $quantityBought;

            $product->stock = $remainingStock;
            $product->save();
        }

        return response()->json(['hasil' => $data, 'success'=>' Data Berhasil Ditambahkan', 'allData'=>$request->all(), 'id'=>$transID, 'dataA'=>$data2]);
    }


    public function getDataRiwayat(){
        $data = Transaction::with('user.employee', 'checkup', 'subtransactions','customer')->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('ACTION', function($data){
         return view('component.btnTableR')->with('data', $data);
        })
        ->make(true);
    }


    public function riwayat(){
        return view('pages.petugas.riwayat');
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $hasil = Subtransaction::where('transID', $id)->with('product', 'transaction','transaction.checkup')->get();
       return response()->json(['hasil'=>$hasil]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
