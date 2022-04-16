<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingOfAssembly;
use DB;
class WorkingOfAssemblyController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:working-of-assembly-list|working-of-assembly-edit', ['only' => ['index','store']]);
         $this->middleware('permission:working-of-assembly-edit', ['only' => ['edit','update']]);
    }
    public function get_workingofassembly($locale='')
    {
        $allRows = DB::table('working_of_assemblies')->where('lang', $locale)->get();
        // dd($allRows);
        return response()->json($allRows);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $singleRow = WorkingOfAssembly::find(1);
        $singleRows = DB::table('working_of_assemblies')->where('lang', app()->getLocale())->where('workid',1)->get()->first();
        return view('workingofassembly', compact('singleRows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       
        // $singleRows = WorkingOfAssembly::find(1);
        $singleRows = DB::table('working_of_assemblies')->where('lang', app()->getLocale())->where('workid',1)->get()->first();
        return view('workingofassembly', compact('singleRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ignore, Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'description' => 'required'
        ]);

        $table = WorkingOfAssembly::find($id);
        $table->heading = $request->heading;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('workingofassembly.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    
}
