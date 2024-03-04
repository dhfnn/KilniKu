<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class supplierController extends Controller
{

    public function  getData(){
        $data = Supplier::orderBy('supplierID', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('ACTION',function($data){
            return view('component.btnTableS')->with('data', $data);
        })
        ->make(true);
    }
        public function index()
    {
        return view('pages.admin.dataSupplier');
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
            'supplierName' => 'required|unique:supplier',
            'phoneNumber' => 'required|min:11', // Menambahkan aturan min:11
        ], [
            'supplierName.required' => 'Nama belum diisi!',
            'supplierName.unique' => 'Nama sudah tersedia!',
            'phoneNumber.required' => 'Nomor telepon belum diisi!',
            'phoneNumber.min' => 'min-11 !',
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }else {
            $data = [
                'supplierName' => $request->supplierName,
                'phoneNumber'=> $request->phoneNumber
            ];
            $tambah = Supplier::create($data);
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
        $data = Supplier::where('supplierID', $id)->first();
        return response()->json(['hasil' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return response()->json(['hasil'=>'halooooooooooooooooooooo']);
        $validate = Validator::make($request->all(), [
            'supplierName' => 'required',
            'phoneNumber' => 'required|min:11',
        ], [
            'supplierName.required' => 'Nama belum diisi!',
            'phoneNumber.required' => 'Nomor telepon belum diisi!',
            'phoneNumber.min' => 'min-11!',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }else {
            $data = [
                'supplierName' => $request->supplierName,
                'phoneNumber'=> $request->phoneNumber
            ];
            $edit = Supplier::where('supplierID', $id)->update($data);
            if ($edit) {
                return response()->json(['success'=>'telah berhasil di dataptkan dan siap di kirim',
                                        'data'   => $data]);
                                    }
                                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::destroy($id);
        return response()->json(['success'=>'telah berhasil dihapus']);
    }
}
