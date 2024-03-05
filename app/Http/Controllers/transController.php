<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\Subtransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class transController extends Controller
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
return view('pages.admin.transaksi', compact('pelanggan', 'user', 'produk','checkup'));
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
                'totalPrice' => $request->totalPrice,
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
            }



                return response()->json(['hasil' => $data, 'success'=>' Data Berhasil Ditambahkan', 'allData'=>$request->all(), 'id'=>$transID, 'dataA'=>$data2]);

}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
