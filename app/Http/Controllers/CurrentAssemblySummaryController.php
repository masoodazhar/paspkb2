<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CurrentAssemblySummary;

class CurrentAssemblySummaryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:current-assembly-summary-list|current-assembly-summary-create|current-assembly-summary-edit|current-assembly-summary-delete', ['only' => ['index','store']]);
         $this->middleware('permission:current-assembly-summary-create', ['only' => ['create','store']]);
         $this->middleware('permission:current-assembly-summary-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:current-assembly-summary-delete', ['only' => ['destroy']]);
    }  

    public function get_currentassemblysummary($tenuresid=false, $locale='en')
    {
        if(is_numeric($tenuresid)){
            $allRows = DB::table('current_assembly_summaries')  
            ->join('assemblies', 'assemblies.id', '=', 'current_assembly_summaries.assembly_id')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'current_assembly_summaries.assembly_tenures_id')
            ->join('parliamentary_years', 'parliamentary_years.id', '=', 'current_assembly_summaries.parliamentary_years_id')
            ->join('sessions', 'sessions.id', '=', 'current_assembly_summaries.main_sessions_id')
            ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
            ->select('current_assembly_summaries.*','assemblies.name as assemblyname','parliamentary_years.name as parliamentaryyearsname','assembly_tenures.fromdate as tenurefromdate','assembly_tenures.todate as tenuretodate','main_sessions.sessionname', 'sessions.id as mainsessionid')
            ->where('current_assembly_summaries.assembly_tenures_id',$tenuresid)
            ->where('current_assembly_summaries.lang',$locale)

            ->get();
        }else{
            $allRows = DB::table('current_assembly_summaries')  
            ->join('assemblies', 'assemblies.id', '=', 'current_assembly_summaries.assembly_id')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'current_assembly_summaries.assembly_tenures_id')
            ->join('parliamentary_years', 'parliamentary_years.id', '=', 'current_assembly_summaries.parliamentary_years_id')
            ->join('sessions', 'sessions.id', '=', 'current_assembly_summaries.main_sessions_id')
            ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
            ->select('current_assembly_summaries.*','assemblies.name as assemblyname','parliamentary_years.name as parliamentaryyearsname','assembly_tenures.fromdate as tenurefromdate','assembly_tenures.todate as tenuretodate','main_sessions.sessionname', 'sessions.id as mainsessionid')
            ->where('current_assembly_summaries.lang',$locale)
            ->get();
        }
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
        $allRows =  DB::table('current_assembly_summaries')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'current_assembly_summaries.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'current_assembly_summaries.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'current_assembly_summaries.assembly_id')
        ->join('sessions', 'sessions.id', '=', 'current_assembly_summaries.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('current_assembly_summaries.*', 'parliamentary_years.name as parliamentaryyearname','assembly_tenures.fromdate as tenfdate','assembly_tenures.todate as tentdate','assemblies.name as assemblyname','main_sessions.sessionname', 'sessions.id as sessionid')
       ->where('current_assembly_summaries.lang',app()->getLocale())
        ->get();

        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->orderBy('id', 'desc')->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();
        $assembly = DB::table('assemblies')->where('lang',app()->getLocale())->get();
        
        $mainSessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname','main_sessions.id as msid')
       ->where('sessions.lang',app()->getLocale())
        ->get();

        return view('currentassemblysummary', compact('allRows','assemblyTenures','parliamentaryYears','assembly','mainSessions'));
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
            'main_sessions_id' => 'required',
            'summonedby' => 'required',
            'fromdate' => 'required',
            'todate' => 'required',
            'actualsittings' => 'required',
            'totalsittings' => 'required',
            'sessiondays' => 'required'
        ]);
        
        // dd($meiansession->main_sessions_id);
        $table = new CurrentAssemblySummary;
        $meiansession = DB::table('sessions')->where('id', $request->main_sessions_id)->get()->first();
        $table->assembly_id = $request->assembly_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->main_sessions_id;
        $table->main_sessions_id = $meiansession->main_sessions_id;
        $table->summonedby = $request->summonedby;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->actualsittings = $request->actualsittings;
        $table->totalsittings = $request->totalsittings;
        $table->sessiondays = $request->sessiondays;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('currentassemblysummary.index')->with(['success'=>'Data has been Saved successfully']);
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
        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->orderBy('id', 'desc')->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();
        $assembly = DB::table('assemblies')->where('lang',app()->getLocale())->get();
        $mainSessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname')
       ->where('sessions.lang',app()->getLocale())
        ->get();
        $singleRow = CurrentAssemblySummary::find($id); 

        $allRows =  DB::table('current_assembly_summaries')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'current_assembly_summaries.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'current_assembly_summaries.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'current_assembly_summaries.assembly_id')
        ->join('sessions', 'sessions.id', '=', 'current_assembly_summaries.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('current_assembly_summaries.*', 'parliamentary_years.name as parliamentaryyearname','assembly_tenures.fromdate as tenfdate','assembly_tenures.todate as tentdate','assemblies.name as assemblyname','main_sessions.sessionname', 'sessions.id as sessionid')
        ->where('current_assembly_summaries.lang',app()->getLocale())
        ->get();
        return view('currentassemblysummary', compact('allRows','singleRow','assemblyTenures','parliamentaryYears','assembly','mainSessions'));
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
            'main_sessions_id' => 'required',
            'summonedby' => 'required',
            'fromdate' => 'required',
            'todate' => 'required',
            'actualsittings' => 'required',
            'totalsittings' => 'required',
            'sessiondays' => 'required'
        ]);


        $table = CurrentAssemblySummary::find($id);
        $meiansession = DB::table('sessions')->where('id', $request->main_sessions_id)->get()->first();
        $table->assembly_id = $request->assembly_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->main_sessions_id;
        $table->main_sessions_id = $meiansession->main_sessions_id;
        $table->summonedby = $request->summonedby;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->actualsittings = $request->actualsittings;
        $table->totalsittings = $request->totalsittings;
        $table->sessiondays = $request->sessiondays;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('currentassemblysummary.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = CurrentAssemblySummary::find($id);
        $singleRow->delete();
        return redirect()->route('currentassemblysummary.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
