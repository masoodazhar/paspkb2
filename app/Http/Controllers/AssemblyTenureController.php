<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssemblyTenure;
use App\Models\Assembly;
use DB;
use Illuminate\Support\Facades\Validator;

class AssemblyTenureController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:assembly-tenure-list|assembly-tenure-create|assembly-tenure-edit|assembly-tenure-delete', ['only' => ['index','store']]);
         $this->middleware('permission:assembly-tenure-create', ['only' => ['create','store']]);
         $this->middleware('permission:assembly-tenure-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:assembly-tenure-delete', ['only' => ['destroy']]);
    }

    public function get_assemblytenure($locale='en')
    {
        $assemblyTenure = AssemblyTenure::orderBy('id', 'DESC')->where('lang', $locale)->get();
        return response()->json($assemblyTenure);

    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assemblytenure = DB::table('assembly_tenures')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('assembly_tenures.*', 'assemblies.name')
        ->where('assembly_tenures.lang', app()->getLocale())
        ->get();
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        // $assemblytenure = AssemblyTenure::all();
        return view('assemblytenure', compact('assemblytenure','assembly'));
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
            'fromdate' => 'required',
            'todate' => 'required'
        ]);


        $assemblytenureData = new AssemblyTenure;
        $assemblytenureData->assembly_id = $request->assembly_id;
        $assemblytenureData->fromdate = $request->fromdate;
        $assemblytenureData->todate = $request->todate;
        $assemblytenureData->lang = app()->getLocale();
        $assemblytenureData->save();
        return redirect()->route('assemblytenure.index')->with(['success'=>'Data has been Saved successfully']);
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
        $assemblytenureData = AssemblyTenure::find($id);
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        $assemblytenure = DB::table('assembly_tenures')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('assembly_tenures.*', 'assemblies.name')
        ->where('assembly_tenures.lang', app()->getLocale())
        ->get();
        return view('assemblytenure', compact('assemblytenure','assemblytenureData','assembly'));
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
            'assembly_id' => 'required',
            'fromdate' => 'required',
            'todate' => 'required'
        ]);

        Validator::make($data, [
            'fromdate' => [
                'required',
                Rule::in(['fromdate', 'todate']),
            ],
        ]);

        $assemblytenureData = AssemblyTenure::find($id);
        $assemblytenureData->assembly_id = $request->assembly_id;
        $assemblytenureData->fromdate = $request->fromdate;
        $assemblytenureData->todate = $request->todate;
        $assemblytenureData->save();
        return redirect()->route('assemblytenure.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $assemblytenureData = AssemblyTenure::find($id);
        $assemblytenureData->delete();
        return redirect()->route('assemblytenure.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
