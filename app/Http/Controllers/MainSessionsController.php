<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainSessions;
use DB;

class MainSessionsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:main-sessions-list|main-sessions-create|main-sessions-edit|main-sessions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:main-sessions-create', ['only' => ['create','store']]);
         $this->middleware('permission:main-sessions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:main-sessions-delete', ['only' => ['destroy']]);
    }  
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows =  DB::table('main_sessions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'main_sessions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'main_sessions.assembly_id')
        ->select('main_sessions.*', 'parliamentary_years.name as parliamentaryyearname','assembly_tenures.fromdate','assembly_tenures.todate','assemblies.name as assemblyname')
        ->where('main_sessions.lang',app()->getLocale())
        ->get();
        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();
        $assembly = DB::table('assemblies')->where('lang',app()->getLocale())->get();

        return view('mainsessions', compact('allRows','assemblyTenures','parliamentaryYears','assembly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'sessionname' => 'required'
        ]);
           
        $table = new MainSessions;
        $table->assembly_id = $request->assembly_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessionname = $request->sessionname;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('mainsessions.index')->with(['success'=>'Data has been Saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ignore, $id)
    {
        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();
        $assembly = DB::table('assemblies')->where('lang',app()->getLocale())->get();

        $singleRow = MainSessions::find($id); 
        $allRows =  DB::table('main_sessions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'main_sessions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'main_sessions.assembly_id')
        ->select('main_sessions.*', 'parliamentary_years.name as parliamentaryyearname','assembly_tenures.fromdate','assembly_tenures.todate','assemblies.name as assemblyname')
        ->where('main_sessions.lang',app()->getLocale())
        ->get();
        return view('mainsessions', compact('allRows','singleRow','assemblyTenures','parliamentaryYears','assembly'));
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
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'sessionname' => 'required'
        ]);

        $table = MainSessions::find($id);
        $table->assembly_id = $request->assembly_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessionname = $request->sessionname;
        $table->save();
        return redirect()->route('mainsessions.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = MainSessions::find($id);
        $singleRow->delete();
        return redirect()->route('mainsessions.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
