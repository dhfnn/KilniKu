<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData(){
        $data =  Pelanggan::orderBy('customerName', 'asc');
         return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('ACTION', function($data){
         return view('component.btnTableP')->with('data', $data);
        })
         ->make(true);

     }
    public function index()
    {
        return view('pages.admin.dataPelanggan');
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
        $validate = Validator::make($request->all(),[
            'customerName' => 'required|unique:customers',
            'phoneNumber'=>'required',
            'address'=>'required'
        ],[
            'customerName.required'=>' Belum diisi!',
            'customerName.unique'=>' Nama sudah tersedia!',
            'phoneNumber.required'=>'Belum diisi!',
            'address.required'=>'Belum diisi!',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }else {
            $data = [
                'customerName' => $request->customerName,
                'address' => $request->address,
                'phoneNumber'=> $request->phoneNumber
            ];
            $tambah = Pelanggan::create($data);
            if ($tambah) {

                return response()->json(['success'=>'telah berhasil di dataptkan dan siap di kirim',
                                        'data'   => $data]);
            }
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
        $data = Pelanggan::where('customerID', $id)->first();
        return response()->json(['hasil' => $data]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(),[
            'customerName' => 'required',
            'phoneNumber'=>'required',
            'address'=>'required'
        ],[
            'customerName.required'=>' Belum diisi!',
            // 'customerName.unique'=>' Nama sudah tersedia!',
            'phoneNumber.required'=>'Belum diisi!',
            'address.required'=>'Belum diisi!',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }else {
            $data = [
                'customerName' => $request->customerName,
                'address' => $request->address,
                'phoneNumber'=> $request->phoneNumber
            ];
            $tambah = Pelanggan::where('customerID' , $id)->update($data);
            if ($tambah) {

                return response()->json(['success'=>'telah berhasil di uabh',
                                        'data'   => $data]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelanggan::destroy($id);    
        return response()->json(['succses'=> 'berhasil dihapus']);
    }
}
