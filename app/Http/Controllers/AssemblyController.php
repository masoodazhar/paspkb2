<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assembly;

class AssemblyController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:assembly-list|assembly-create|assembly-edit|assembly-delete', ['only' => ['index','store']]);
         $this->middleware('permission:assembly-create', ['only' => ['create','store']]);
         $this->middleware('permission:assembly-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:assembly-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        return view('assembly', compact('assembly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25'
        ]);

        $assemblyData = new Assembly;
        $assemblyData->name = $request->name;
        $assemblyData->lang = app()->getLocale();
        $assemblyData->save();
        return redirect()->route('assembly.index')->with(['success'=>'Data has been Saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ignore,$id)
    {
        $assemblyData = Assembly::find($id);
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        // dd($s);
        return view('assembly', compact('assemblyData','assembly'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ddddd, Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:25'
        ]);

        $assemblyData = Assembly::find($id);
        $assemblyData->name = $request->name;
        $assemblyData->save();
        return redirect()->route('assembly.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $assemblyData = Assembly::find($id);
        $assemblyData->delete();
        return redirect()->route('assembly.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
