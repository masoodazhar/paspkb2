<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Acts;
use App\Models\AssemblyTenure;
use App\Models\ParliamentaryYears;
use App\Models\Sessions;
use App\Models\OrderOfTheDaySummaryOfProceedings;

class ActsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:acts-list|acts-create|acts-edit|acts-delete', ['only' => ['index','store']]);
         $this->middleware('permission:acts-create', ['only' => ['create','store']]);
         $this->middleware('permission:acts-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:acts-delete', ['only' => ['destroy']]);
    }  

    public function get_acts($tenurid, $locale='en'){
        $allRows = DB::table('acts')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'acts.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'acts.parliamentary_years_id')
        ->join('sessions', 'sessions.id', '=', 'acts.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'acts.order_of_the_day_summary_of_proceedings_id')
        ->select('acts.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno')
        ->where('acts.assembly_tenures_id', $tenurid)
        ->where('acts.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_actdetail($id){
        $allRows = DB::table('acts')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'acts.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'acts.parliamentary_years_id')
        ->join('sessions', 'sessions.id', '=', 'acts.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'acts.order_of_the_day_summary_of_proceedings_id')
        ->select('acts.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno')
        ->where('acts.id', $id)
        ->first();
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
        $allRows = DB::table('acts')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'acts.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'acts.parliamentary_years_id')
        ->join('sessions', 'sessions.id', '=', 'acts.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'acts.order_of_the_day_summary_of_proceedings_id')
        ->select('acts.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.*')
        ->where('acts.lang',app()->getLocale())
        ->get();

        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all()->where('lang',app()->getLocale());
        $sessions = Sessions::all()->where('lang',app()->getLocale());
        $orderOfTheDaySummaryOfProceedings = OrderOfTheDaySummaryOfProceedings::all()->where('lang',app()->getLocale());
        // return $parliamentaryyears
        return view('acts', compact('allRows','assemblyTenure','parliamentaryYears','sessions','orderOfTheDaySummaryOfProceedings'));
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
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'sessions_id' => 'required',
            'order_of_the_day_summary_of_proceedings_id' => 'required',
            'actno' => 'required',
            'title' => 'required',
            'dateofpassing' => 'required',
            'dateofgov' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = new Acts;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->sessions_id;
        $table->order_of_the_day_summary_of_proceedings_id = $request->order_of_the_day_summary_of_proceedings_id;
        $table->actno = $request->actno;
        $table->title = $request->title;
        $table->dateofpassing = $request->dateofpassing;
        $table->dateofgov = $request->dateofgov;
        $table->type = $request->type;
        $table->lang = app()->getLocale();
        
         if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $table->image_pdf_link =  $imageName;             
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $table->image_pdf_link = $request->image_pdf_link;
        }
        $table->save();
        return redirect()->route('acts.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Acts::find($id);

        $allRows = DB::table('acts')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'acts.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'acts.parliamentary_years_id')
        ->join('sessions', 'sessions.id', '=', 'acts.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'acts.order_of_the_day_summary_of_proceedings_id')
        ->select('acts.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno')
        ->where('acts.lang',app()->getLocale())
        ->get();
        
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('bills.lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all()->where('bills.lang',app()->getLocale());
        $sessions = Sessions::all()->where('bills.lang',app()->getLocale());
        $orderOfTheDaySummaryOfProceedings = OrderOfTheDaySummaryOfProceedings::all()->where('bills.lang',app()->getLocale());
        // return $parliamentaryyears
        return view('acts', compact('singleRow','allRows','assemblyTenure','parliamentaryYears','sessions','orderOfTheDaySummaryOfProceedings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assembly_tenures_id' => 'required',
            'parliamentary_years_id' => 'required',
            'sessions_id' => 'required',
            'order_of_the_day_summary_of_proceedings_id' => 'required',
            'actno' => 'required',
            'title' => 'required',
            'dateofpassing' => 'required',
            'dateofgov' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = Acts::find($id);
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->sessions_id;
        $table->order_of_the_day_summary_of_proceedings_id = $request->order_of_the_day_summary_of_proceedings_id;
        $table->actno = $request->actno;
        $table->title = $request->title;
        $table->dateofpassing = $request->dateofpassing;
        $table->dateofgov = $request->dateofgov;
        $table->type = $request->type;
         if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $table->image_pdf_link =  $imageName;             
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $table->image_pdf_link = $table->image_pdf_link;
        }
        $table->save();
        return redirect()->route('acts.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Acts::find($id);
        $table->delete();
        return redirect()->route('acts.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
