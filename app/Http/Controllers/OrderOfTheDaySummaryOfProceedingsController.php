<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderOfTheDaySummaryOfProceedings;
use DB;
use App\Models\Questions;

class OrderOfTheDaySummaryOfProceedingsController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:order-of-the-day-summary-of-proceedings-list|order-of-the-day-summary-of-proceedings-create|order-of-the-day-summary-of-proceedings-edit|order-of-the-day-summary-of-proceedings-delete', ['only' => ['index','store']]);
         $this->middleware('permission:order-of-the-day-summary-of-proceedings-create', ['only' => ['create','store']]);
         $this->middleware('permission:order-of-the-day-summary-of-proceedings-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:order-of-the-day-summary-of-proceedings-delete', ['only' => ['destroy']]);
    }  

    public function get_sittingsbyidorderoftheday($id, $locale='en'){
        $allRows = DB::table('order_of_the_day_summary_of_proceedings as ord')
        ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
        ->select('sessions.*','ord.description','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
        ->where('ord.id', $id)
        ->where('ord.lang', $locale)
        ->first();
        return response()->json($allRows);
    }
    public function get_sittingsbyidquestion($id, $locale='en'){
        $allRows = Questions::all()->where('id', $id)->where('lang', $locale)->first();
        return response()->json($allRows);
    }
    public function get_orderofthedayagendasessionsbased($tenureid,$mainsession, $locale='en')
    {
                  
        $allRows = DB::table('order_of_the_day_summary_of_proceedings as ord')
        ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('sessions.*','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
        ->where('sessions.main_sessions_id', $mainsession)
        ->where('main_sessions.assembly_tenures_id',$tenureid)
        ->where('ord.lang',$locale)
        ->get();
        
        
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_resolutionpassedsessionsbased($tenureid,$mainsession, $locale='en')
    {
        // resolutions_passeds
        $allRows = DB::table('resolutions_passeds as ord')
        ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('sessions.*','ord.id as resolutionid','ord.date as resolutiondate')
        ->where('sessions.main_sessions_id', $mainsession)
        ->where('main_sessions.assembly_tenures_id',$tenureid)
        ->where('ord.lang',$locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_questionasessionsbased($tenureid,$mainsession, $locale='en')
    {
        $allRows = DB::table('questions as ord')
        ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('sessions.*','ord.id as questionid','ord.date as questiondate','ord.number')
        ->where('sessions.main_sessions_id', $mainsession)
        ->where('main_sessions.assembly_tenures_id',$tenureid)
        ->where('ord.lang',$locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_orderofthedayagenda($page,$tenureid, $locale='en'){
        $allmainSessions = DB::table('order_of_the_day_summary_of_proceedings')  
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'main_sessions.parliamentary_years_id')
        ->select('main_sessions.*','parliamentary_years.name as parliname')
        ->where('main_sessions.assembly_tenures_id',$tenureid)
        ->where('order_of_the_day_summary_of_proceedings.sittingstype',$page)
        ->where('order_of_the_day_summary_of_proceedings.lang',$locale)
        ->orderBy('main_sessions.sessionname')
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,10000, true);

        // dd($allmainSessions);
        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('order_of_the_day_summary_of_proceedings as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
            ->where('ord.sittingstype',$page)
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'parliname'=>$msession->parliname,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
            // echo $msession->sessionname;
        }
        // dd($allRows);
        return response()->json($allRows);

    }
  
    public function get_orderofthedayagendabyid($page,$id, $locale='en')
    {
        $allRows = DB::table('order_of_the_day_summary_of_proceedings')  
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->select('order_of_the_day_summary_of_proceedings.*','sessions.fromdate','sessions.todate')
        ->where('order_of_the_day_summary_of_proceedings.sittingstype',$page)
        ->where('order_of_the_day_summary_of_proceedings.id', $id)
        ->where('order_of_the_day_summary_of_proceedings.lang', $locale)
        ->get()
        ->first();
        return response()->json($allRows);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows =  DB::table('order_of_the_day_summary_of_proceedings')
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->select('order_of_the_day_summary_of_proceedings.*', 'sessions.fromdate','sessions.todate')
        ->where('order_of_the_day_summary_of_proceedings.lang',app()->getLocale())
        ->get();

        $sessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname')
       ->where('sessions.lang',app()->getLocale())
        ->get();
        return view('orderoftheday_summaryofproceedings', compact('allRows','sessions'));
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
            'sessions_id' => 'required',
            'sittingsdate' => 'required',
            'sittingstype' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);
           
        $table = new OrderOfTheDaySummaryOfProceedings;
        $table->sessions_id = $request->sessions_id;
        $table->sittingsdate = $request->sittingsdate;
        $table->sittingsno = $request->sittingsno;
        $table->sittingstype = $request->sittingstype;
        $table->type = $request->type;
        $table->lang = app()->getLocale();

        if($request->sittingsno == ''){
            $table->sittingsno = '-';
        }else{
            $table->sittingsno = $request->sittingsno;
        }
        
        if($request->hasFile('description')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->description->extension();       
                $request->description->move(public_path('uploads'), $imageName);
                $table->description =  $imageName;             
            }else{
                $table->description = $request->description;
            }
        }else{
            $table->description = $request->description;
        }
        $table->referencenumber = $request->referencenumber;
        $table->save();
        return redirect()->route('otdsummaryofproceedings.index')->with(['success'=>'Data has been Saved successfully']);
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
        $sessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname')
       ->where('sessions.lang',app()->getLocale())
        ->get();

        $singleRow = OrderOfTheDaySummaryOfProceedings::find($id); 
        $allRows =  DB::table('order_of_the_day_summary_of_proceedings')
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->select('order_of_the_day_summary_of_proceedings.*', 'sessions.fromdate','sessions.todate')
        ->where('order_of_the_day_summary_of_proceedings.lang',app()->getLocale())
        ->get();
        return view('orderoftheday_summaryofproceedings', compact('allRows','singleRow','sessions'));
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
            'sessions_id' => 'required',
            'sittingsdate' => 'required',
            'sittingstype' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);

        $table = OrderOfTheDaySummaryOfProceedings::find($id);
        $table->sessions_id = $request->sessions_id;
        $table->sittingsdate = $request->sittingsdate;
        
        $table->type = $request->type;
        $table->sittingstype = $request->sittingstype;
        if($request->sittingsno == ''){
            $table->sittingsno = '-';
        }else{
            $table->sittingsno = $request->sittingsno;
        }
        if($request->hasFile('description')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->description->extension();       
                $request->description->move(public_path('uploads'), $imageName);
                $table->description =  $imageName;             
            }else{
                $table->description = $request->description;
            }
        }else{
            $table->description = $request->description;
        }
        $table->referencenumber = $request->referencenumber;
        $table->save();
        return redirect()->route('otdsummaryofproceedings.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = OrderOfTheDaySummaryOfProceedings::find($id);
        $singleRow->delete();
        return redirect()->route('otdsummaryofproceedings.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
