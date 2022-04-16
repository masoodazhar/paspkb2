<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ParliamentaryCalendar;
use App\Models\Assembly;
use App\Models\AssemblyTenure;
use App\Models\ParliamentaryYears;

class ParliamentaryCalendarController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:parliamentary-calendar-list|parliamentary-calendar-create|parliamentary-calendar-edit|parliamentary-calendar-delete', ['only' => ['index','store']]);
         $this->middleware('permission:parliamentary-calendar-create', ['only' => ['create','store']]);
         $this->middleware('permission:parliamentary-calendar-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:parliamentary-calendar-delete', ['only' => ['destroy']]);
    } 

    public function get_parliamentarycalendar($tenure){
        $allRows = DB::table('parliamentary_calendars')
        ->where('parliamentary_calendars.assembly_tenures_id', $tenure)
        ->select('parliamentary_calendars.*')
        ->get();
        return response()->json($allRows);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = DB::table('parliamentary_calendars')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'parliamentary_calendars.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'parliamentary_calendars.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'parliamentary_calendars.assemblies_id')
        ->select('parliamentary_calendars.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate as atfromdate','assembly_tenures.todate as attodate','assemblies.name as assemblyname')
        ->get();
        // $assemblyTenure = AssemblyTenure::all();
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all();
        $assemblies = Assembly::all();
        // return $parliamentaryyears
        return view('parliamentarycalendar', compact('allRows','assemblyTenure','parliamentaryYears','assemblies'));
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
            'assemblies_id' => 'required',
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'fromdate' => 'required',
            'type' => 'required'            
        ]);

        $table = new ParliamentaryCalendar;
        $table->assemblies_id = $request->assemblies_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->fromdate = $request->fromdate;
        $table->type = $request->type;
        
        $table->save();
        return redirect()->route('parliamentarycalendar.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = ParliamentaryCalendar::find($id);

        $allRows = DB::table('parliamentary_calendars')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'parliamentary_calendars.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'parliamentary_calendars.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'parliamentary_calendars.assemblies_id')
        ->select('parliamentary_calendars.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate as atfromdate','assembly_tenures.todate as attodate','assemblies.name as assemblyname')
        ->get();
        
        // $assemblyTenure = AssemblyTenure::all();
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all();
        $assemblies = Assembly::all();
        return view('parliamentarycalendar', compact('singleRow','allRows','assemblyTenure','parliamentaryYears','assemblies'));
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
            'assemblies_id' => 'required',
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'fromdate' => 'required',
            'type' => 'required' 
        ]);

        $table = ParliamentaryCalendar::find($id);
        $table->assemblies_id = $request->assemblies_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->fromdate = $request->fromdate;
        $table->type = $request->type;
        $table->save();
        return redirect()->route('parliamentarycalendar.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $table = ParliamentaryCalendar::find($id);
        $table->delete();
        return redirect()->route('parliamentarycalendar.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
