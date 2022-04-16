<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessions;
use DB;

class SessionsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:sessions-list|sessions-create|sessions-edit|sessions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:sessions-create', ['only' => ['create','store']]);
         $this->middleware('permission:sessions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sessions-delete', ['only' => ['destroy']]);
    }  

    public function get_sessions($tenureid, $locale='en')
    {
        $allmainSessions = DB::table('main_sessions')  
        ->join('assemblies', 'assemblies.id', '=', 'main_sessions.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'main_sessions.parliamentary_years_id')
        ->select('main_sessions.*','assemblies.name as assemblyname','parliamentary_years.name as parliamentaryyearsname','assembly_tenures.fromdate as tenurefromdate','assembly_tenures.todate as tenuretodate')
        
        ->where('main_sessions.assembly_tenures_id',$tenureid)
        ->where('main_sessions.lang',$locale)
        ->get();
        $allRows = [];
        foreach ($allmainSessions as $msession){            
            $sessions = DB::table('sessions')

            ->select('*')
            ->where('main_sessions_id', $msession->id)
            ->where('sessions.lang',$locale)
            ->get();

            $sess = array(
                'id'=>$msession->id,
                'sessionname'=>$msession->sessionname,
                'assembly'=> $msession->assemblyname,
                'parliamentaryyearsname'=> $msession->parliamentaryyearsname,
                'listofsessions'=>$sessions
            );  
            
            array_push($allRows,$sess);
            // echo $msession->sessionname;
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
        $allRows =  DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('sessions.*', 'main_sessions.sessionname')
        ->where('sessions.lang',app()->getLocale())
        ->get();
        $mainSessions = DB::table('main_sessions')->where('lang',app()->getLocale())->get();

        return view('sessions', compact('allRows','mainSessions'));
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
            'main_sessions_id' => 'required',
            'fromdate' => 'required',
            'todate' => 'required'
        ]);
           
        $table = new Sessions;
        $table->main_sessions_id = $request->main_sessions_id;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('sessions.index', app()->getLocale())->with(['success'=>'Data has been Saved successfully']);
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
        $mainSessions = DB::table('main_sessions')->where('lang',app()->getLocale())->get();
        $singleRow = Sessions::find($id); 
        $allRows =  DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('sessions.*', 'main_sessions.sessionname')
        ->where('sessions.lang',app()->getLocale())
        ->get();
        return view('sessions', compact('allRows','singleRow','mainSessions'));
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
            'main_sessions_id' => 'required',
            'fromdate' => 'required',
            'todate' => 'required'
        ]);

        $table = Sessions::find($id);
        $table->main_sessions_id = $request->main_sessions_id;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->save();
        return redirect()->route('sessions.index', app()->getLocale())->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = Sessions::find($id);
        $singleRow->delete();
        return redirect()->route('sessions.index', app()->getLocale())->with(['success'=>'Data has been Deleted successfully']);
    }
}
