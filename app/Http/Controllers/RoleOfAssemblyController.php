<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleOfAssembly;
use DB;
class RoleOfAssemblyController extends Controller
{
    public function get_roleofassembly($locale='')
    {
        $allRows = DB::table('role_of_assemblies')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $singleRow = RoleOfAssembly::find(1);
        $singleRows = DB::table('role_of_assemblies')->where('lang', app()->getLocale())->where('roleid',1)->get()->first();
        return view('roleofassembly', compact('singleRows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
       
        // $singleRow = RoleOfAssembly::find(1);
        $singleRows = DB::table('role_of_assemblies')->where('lang', app()->getLocale())->where('roleid',1)->get()->first();
        return view('roleofassembly', compact('singleRows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ignore,Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'description' => 'required'
        ]);

        $table = RoleOfAssembly::find($id);
        $table->heading = $request->heading;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('roleofassembly.index')->with(['success'=>'Data has been Updated successfully']);
        
    }
}
