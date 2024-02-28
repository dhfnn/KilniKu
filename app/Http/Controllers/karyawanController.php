<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
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
        //
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
