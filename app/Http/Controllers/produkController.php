<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class produkController extends Controller
{
    public function getsupplier(){
        $suppliers = Supplier::select('supplierID', 'supplierName')->distinct()->get();
        return response()->json(['hasil' => $suppliers]);
    }
    public function getData(){
        $products = Product::all();
        return response()->json($products);
    }
    public function index()
    {
        return view('pages.admin.produk');
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

$validate = Validator::make($request->all(), [
    'name' => 'required|string',
    'stock' => 'required|integer|min:0',
    'description' => 'required|string|max:90',
    'expiryDate' => 'required|date',
    'purchasePrice' => 'required|numeric|min:0',
    'sellingPrice' => 'required|numeric|min:0',
    'category' => 'required|string',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'supplierID'=> 'required',


], [
    'name.required' => 'Belum diisi!',
    'stock.required' => 'Belum diisi!',
    'stock.integer' => 'harus angka!',
    'stock.min' => 'Kurang dari 0!',
    'description.required' => 'Belum diisi!',
    'expiryDate.required' => 'Belum diisi!',
    'purchasePrice.required' => 'Belum diisi!',
    'purchasePrice.numeric' => 'Harus angka!',
    'purchasePrice.min' => 'Kurang dari 0!',
    'sellingPrice.required' => 'Belum diisi!',
    'sellingPrice.numeric' => 'Harus berupa angka!',
    'sellingPrice.min' => 'Kurang dari 0!',
    'category.required' => 'Belum diisi!',
    'supplierID.required' => 'Belum diisi',
    'image.required' => 'Belum diisi!',
    'description.max'     =>'Maks 90 Karakter'


]);

if ($validate->fails()) {
    return response()->json(['errors' => $validate->errors()]);
}else{
    $image = $request->file('image');
    $filename = date('Y-m-d').'_'.$image->getClientOriginalName(); // Menggunakan 'd' untuk tanggal, bukan 'D'
    $path = 'image-products/'.$filename;    
    Storage::disk('public')->put($path, file_get_contents($image));

    $data = [
        'name' => $request->name,
        'stock' => $request->stock,
        'description' => $request->description,
        'expiryDate' => $request->expiryDate,
        'purchasePrice' => $request->purchasePrice,
        'sellingPrice' => $request->sellingPrice,
        'category' => $request->category,
        'image' => $filename,
        'supplierID' => $request->supplierID,
    ];
    
    Product::create($data);
    return response()->json(['hasil' => $data, 'success'=>' data berhasil di tambahkan']);
}

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
        $product = Product::with('supplier')->find($id);
        return response()->json(['hasil' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   
                $validate = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'stock' => 'required|integer|min:0',
                    'description' => 'required|string|max:90',
                    'expiryDate' => 'required|date',
                    'purchasePrice' => 'required|numeric|min:0',
                    'sellingPrice' => 'required|numeric|min:0',
                    'category' => 'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    'supplierID'=> 'required'
                ], [
                    'name.required' => 'belum diisi!',
                    'stock.required' => 'Stok belum diisi!',
                    'stock.integer' => 'Stok harus berupa angka!',
                    'stock.min' => 'Stok tidak boleh kurang dari 0!',
                    'description.required' => 'Deskripsi belum diisi!',
                    'expiryDate.required' => 'Tanggal kadaluarsa belum diisi!',
                    'expiryDate.date' => 'Tanggal kadaluarsa harus berupa tanggal!',
                    'purchasePrice.required' => 'Harga beli belum diisi!',
                    'purchasePrice.numeric' => 'Harga beli harus berupa angka!',
                    'purchasePrice.min' => 'Harga beli tidak boleh kurang dari 0!',
                    'sellingPrice.required' => 'Harga jual belum diisi!',
                    'sellingPrice.numeric' => 'Harga jual harus berupa angka!',
                    'sellingPrice.min' => 'Harga jual tidak boleh kurang dari 0!',
                    'category.required' => 'Kategori belum diisi!',
                    'supplierID.required' => 'Supplier belum diisi',
                    'description.max'     =>'Maks 90 Karakter'

                ]);

                $hasill = [
                    'name' => $request->name,
                    'stock' => $request->stock,
                    'description' => $request->description,
                    'expiryDate' => $request->expiryDate,
                    'purchasePrice' => $request->purchasePrice,
                    'sellingPrice' => $request->sellingPrice,
                    'category' => $request->category,
                    'image' => $request->image,
                    'supplierID' => $request->supplierID,
                ];
                if ($validate->fails()) {
                    return response()->json(['errors' => $validate->errors(), 'hasil'=> $hasill]);
                }else{
                    if ($request->hasFile('image')) {
                        $file = $request->file('image');
                        $filename = date('Y-m-d').'_'.$file->getClientOriginalName();
                        $path = 'image-products/'.$filename;
                        Storage::disk('public')->put($path, file_get_contents($file));
            
                    }else{

                        $imgData = Product::where('productID', $id)->first();
                        $filename = $imgData->image;
                    }
                    $data = [
                        'name' => $request->name,
                        'stock' => $request->stock,
                        'description' => $request->description,
                        'expiryDate' => $request->expiryDate,
                        'purchasePrice' => $request->purchasePrice,
                        'sellingPrice' => $request->sellingPrice,
                        'category' => $request->category,
                        'image' => $filename,
                        'supplierID' => $request->supplierID,
                    ];
                    
                    Product::where('productID',$id )->update($data);
                    return response()->json(['hasil' => $data, 'success'=>' data berhasil di ubah']);
                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json(['hasil' => $id]);
    }
}
