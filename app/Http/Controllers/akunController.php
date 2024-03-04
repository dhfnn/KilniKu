<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class akunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDataEm(){
        $data = Employee::all();
        return response()->json(['hasil'=>$data]);
    }
    public function getData(){
       $data =  Users::with('employee')->get();
        return DataTables::of($data)
       ->addIndexColumn()
       ->addColumn('ACTION', function($data){
        return view('component.btnTable')->with('data', $data);
       })
        ->make(true);

    }
    public function index()
    {
        return view('pages.admin.dataAkun');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'employeeID'=> 'required',
            'username'=> 'required|unique:Users',
            'password'=>'required',
            'role'=>'required'
        ],
        [
            'employeeID.required'=>' Belum diisi!',
            'username.required'=>'Belum diisi!',
            'password.required'=>'Belum diisi!',
            'role.required'=>'belum dipilih!',
            'username.unique' => 'Username sudah tersedia!'
        ]);
            if ($validate->fails()) {
                return response()->json(['errors'=> $validate->errors()]);
            }else {
                $data = [
                    'username' => $request->username,
                    'employeeID' => $request->employeeID,
                    'password' =>  Hash::make($request->password),
                    'role' => $request->role

                ];
                $u = $request->username;
                if (Users::where('username', $u )->exists()) {
                    return response()->json(['duplicate'=> "Data sudah ada !"]);
                }else{
                    $o =   Users::create($data);
                    return response()->json(['success'=> "Data berhasil ditambahkan", 'hasildata'=> $data]);
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
        $dataEm = Employee::all();
        $data = Users::with('employee')->find($id);
        return response()->json(['hasil' => $data ,'dataEm'=>$dataEm]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'employeeID'=> 'required',
            'username'=> 'required',
            'role'=>'required'
        ],
        [
            'employeeID.required'=>' Belum diisi!',
            'username.required'=>'Belum diisi!',
            'password.required'=>'Belum diisi!',
            'role.required'=>'belum dipilih!',
        ]);
            if ($validate->fails()) {
                return response()->json(['errors'=> $validate->errors()]);
            }else {
                $data = [
                    'username' => $request->username,
                    'employeeID' => $request->employeeID,
                    'role' => $request->role

                ];
                if ($request->filled('password')) {
                    $data['password'] = Hash::make($request->password);
                }
                    Users::where('id', $id)->update($data);
                    return response()->json(['success'=> "Data berhasil ditambahkan"]);
                }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        user::destroy($id);
        return response()->json(['berhasil'=>"berhasil di hapus"]);
    }
}
