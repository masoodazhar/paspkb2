<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Assembly;
use App\Models\AssemblyTenure;
use App\Models\ParliamentaryYears;

class ParliamentaryYearsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:parliamentory-year-list|parliamentory-year-create|parliamentory-year-edit|parliamentory-year-delete', ['only' => ['index','store']]);
         $this->middleware('permission:parliamentory-year-create', ['only' => ['create','store']]);
         $this->middleware('permission:parliamentory-year-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:parliamentory-year-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parliamentaryyears = DB::table('parliamentary_years')
        ->join('assemblies', 'assemblies.id', '=', 'parliamentary_years.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'parliamentary_years.assemblytenures_id')
        ->select('parliamentary_years.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('parliamentary_years.lang', app()->getLocale())
        ->get();
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        // return $parliamentaryyears
        return view('parliamentaryyears', compact('parliamentaryyears','assembly','assemblyTenure'));
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
            'assembly_id' => 'required',
            'assemblytenures_id' => 'required',
            'pyfromdate' => 'required',
            'pytodate' => 'required',
            'name' => 'required'
        ]);

        $parliamentaryyearsData = new ParliamentaryYears;
        $parliamentaryyearsData->assembly_id = $request->assembly_id;
        $parliamentaryyearsData->assemblytenures_id = $request->assemblytenures_id;
        $parliamentaryyearsData->name = $request->name;
        $parliamentaryyearsData->pyfromdate = $request->pyfromdate;
        $parliamentaryyearsData->pytodate = $request->pytodate;
        $parliamentaryyearsData->lang = app()->getLocale();
        $parliamentaryyearsData->save();
        return redirect()->route('parliamentaryyear.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($ignore, $id)
    {
        
        $parliamentaryyearsData = ParliamentaryYears::find($id);
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        $parliamentaryyears = DB::table('parliamentary_years')
        ->join('assemblies', 'assemblies.id', '=', 'parliamentary_years.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'parliamentary_years.assemblytenures_id')
        ->where('parliamentary_years.lang', app()->getLocale())
        ->select('parliamentary_years.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate')
        
        ->get();
        // return $parliamentaryyearsData;
        return view('parliamentaryyears', compact('parliamentaryyears','parliamentaryyearsData','assembly','assemblyTenure'));
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
            'assembly_id' => 'required',
            'assemblytenures_id' => 'required',
            'pyfromdate' => 'required',
            'pytodate' => 'required',
            'name' => 'required'
        ]);

        $parliamentaryyearsData = ParliamentaryYears::find($id);
        $parliamentaryyearsData->assembly_id = $request->assembly_id;
        $parliamentaryyearsData->assemblytenures_id = $request->assemblytenures_id;
        $parliamentaryyearsData->name = $request->name;
        $parliamentaryyearsData->pyfromdate = $request->pyfromdate;
        $parliamentaryyearsData->pytodate = $request->pytodate;
        $parliamentaryyearsData->save();
        return redirect()->route('parliamentaryyear.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $parliamentaryyearsData = ParliamentaryYears::find($id);
        $parliamentaryyearsData->delete();
        return redirect()->route('parliamentaryyear.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
