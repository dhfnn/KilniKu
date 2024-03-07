<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator ;
use Yajra\DataTables\Facades\DataTables;


class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData(){
        $data = Employee::orderBy('employeeID', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('ACTION',function($data){
            return view('component.btnTableK')->with('data', $data);
        })
        ->make(true);
    }
    public function index()
    {
        return view('pages.admin.dataKaryawan');
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
            'name' => 'required|unique:employees,name',
            'position' => 'required',
            'birthdate' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
            'startWork' => 'required',
            'image'=>'required'
        ], [
            'name.required' => 'belum diisi!',
            'name.unique' => 'nama sudah tersedia!',
            'position.required' => 'belum diisi!',
            'birthdate.required' => 'belum diisi!',
            'phoneNumber.required' => 'belum diisi!',
            'address.required' => 'belum diisi!',
            'startWork.required' => 'belum diisi!',
            'image.required'=>'belum diisi!'

        ]);
            if ($validate->fails()) {
                return response()->json(['errors'=> $validate->errors()]);
            }else {
                $image = $request->file('image');
                $filename = date('Y-m-d').'_'.$image->getClientOriginalName();
                $path = 'image-products/'.$filename;
                Storage::disk('public')->put($path, file_get_contents($image));
                $data = [
                    'name' => $request->name,
                    'position' => $request->position,
                    'birthdate' => $request->birthdate,
                    'phoneNumber' => $request->phoneNumber,
                    'address' => $request->address,
                    'startWork' => $request->startWork,
                    'gender' => $request->gender,
                    'image'=>$filename
                ];

                $u = $request->name;
                if (Employee::where('name', $u )->exists()) {
                    return response()->json(['duplicate'=> "Data sudah ada !"]);
                }else{
                    $o =   Employee::create($data);
                    return response()->json(['success'=> "Data berhasil ditambahkan"]);
                }

}

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Employee::where('employeeID' ,$id)->first();
        return response()->json(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'birthdate' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
            'startWork' => 'required',
        ], [
            'name.required' => 'belum diisi!',
            'position.required' => 'belum diisi!',
            'birthdate.required' => 'belum diisi!',
            'phoneNumber.required' => 'belum diisi!',
            'address.required' => 'belum diisi!',
            'startWork.required' => 'belum diisi!',

        ]);
        $filename = '';
        $img = Employee::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('Y-m-d').'_'.$file->getClientOriginalName();
            $path = 'image-products/'.$filename;
            Storage::disk('public')->put($path, file_get_contents($file));

        }else{
            $imgData = Employee::where('employeeID', $id)->first();
            $filename = $imgData->image;
        }
        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'birthdate' => $request->birthdate,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'startWork' => $request->startWork,
            'gender' => $request->gender,
            'image'=>$filename
        ];
            if ($validate->fails()) {
                // return response()->json(['hasil'=>'haloooooooo']);
                return response()->json(['hasil'=>$data]);
                return response()->json(['errors'=> $validate->errors()]);
            }else {
                    Employee::where('employeeID', $id)->update($data);
                    return response()->json(['success'=> "Data berhasil ditambahkan"]);

}

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Users::where('employeeID', $id)->delete();
        Employee::destroy($id);
        return response()->json(['success'=>'berhasil dihapus']);
    }
}
