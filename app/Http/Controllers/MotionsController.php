<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Motions;
use App\Models\Assembly;
use App\Models\AssemblyTenure;
use App\Models\ParliamentaryYears;
use App\Models\Sessions;
use App\Models\OrderOfTheDaySummaryOfProceedings;
use App\Models\MembersDirectory;


class MotionsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:motions-list|motions-create|motions-edit|motions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:motions-create', ['only' => ['create','store']]);
         $this->middleware('permission:motions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:motions-delete', ['only' => ['destroy']]);
    } 

    public function get_getListOfAssembly($locale='en'){
        $assembly = DB::table('assemblies')->where('lang', $locale)->get();
        // dd($assembly);
        return response()->json($assembly);
    }

    public function get_getListOfParliamentaryYears($locale='en'){
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang', $locale)->get();
        // dd($parliamentaryYears);
        return response()->json($parliamentaryYears);
    }

    public function get_getListOfSessions($locale='en')
    {
        $sessions = DB::table('sessions')->where('lang', $locale)->get();
        // dd($sessions);
        return response()->json($sessions);
    }

    public function get_getListOfOrderOfTheDaySummaryOfProceedings($locale='en')
    {
        $orderOfTheDaySummaryOfProceedings = DB::table('order_of_the_day_summary_of_proceedings')
        ->select('order_of_the_day_summary_of_proceedings.sittingsno')
        ->distinct()
        ->where('lang', $locale)
        ->get();
        // dd($orderOfTheDaySummaryOfProceedings);
        return response()->json($orderOfTheDaySummaryOfProceedings);
    }

    public function get_motions($tenureid, $locale='en'){

        $allRows = DB::table('motions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'motions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'motions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'motions.assemblies_id')
        ->join('sessions', 'sessions.id', '=', 'motions.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'motions.order_of_the_day_summary_of_proceedings_id')
        ->join('members_directories', 'members_directories.id', '=', 'motions.members_directories_id')
        ->select('motions.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno','assemblies.name as assemblyname','members_directories.name as membername')
        ->where('motions.assembly_tenures_id', $tenureid)
        ->where('motions.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_motionsdetail($id)
    {
        $allRows = DB::table('motions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'motions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'motions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'motions.assemblies_id')
        ->join('sessions', 'sessions.id', '=', 'motions.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'motions.order_of_the_day_summary_of_proceedings_id')
        ->join('members_directories', 'members_directories.id', '=', 'motions.members_directories_id')
        ->select('motions.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno','assemblies.name as assemblyname','members_directories.name as membername')
        ->where('motions.id', $id)
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
        $allRows = DB::table('motions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'motions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'motions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'motions.assemblies_id')
        ->join('sessions', 'sessions.id', '=', 'motions.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'motions.order_of_the_day_summary_of_proceedings_id')
        ->join('members_directories', 'members_directories.id', '=', 'motions.members_directories_id')
        ->select('motions.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno','assemblies.name as assemblyname','members_directories.name as membername')
        ->where('motions.lang',app()->getLocale())
        ->get();

        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all()->where('lang',app()->getLocale());
        $sessions = Sessions::all()->where('lang',app()->getLocale());
        $assemblies = Assembly::all()->where('lang',app()->getLocale());
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        $orderOfTheDaySummaryOfProceedings = OrderOfTheDaySummaryOfProceedings::all()->where('lang',app()->getLocale());
        // return $parliamentaryyears
        return view('motions', compact('allRows','assemblyTenure','parliamentaryYears','sessions','orderOfTheDaySummaryOfProceedings','membersDirectories','assemblies'));
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
            'sessions_id' => 'required',
            'order_of_the_day_summary_of_proceedings_id' => 'required',
            'members_directories_id' => 'required',
            'status' => 'required',
            'motiontype' => 'required',
            'motionno' => 'required',
            'title' => 'required',
            'typetabs' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = new Motions;
        $table->assemblies_id = $request->assemblies_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->sessions_id;
        $table->order_of_the_day_summary_of_proceedings_id = $request->order_of_the_day_summary_of_proceedings_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->status = $request->status;
        $table->motiontype = $request->motiontype;
        $table->motionno = $request->motionno;
        $table->title = $request->title;
        $table->typetabs = $request->typetabs;
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
        return redirect()->route('motions.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Motions::find($id);

        $allRows = DB::table('motions')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'motions.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'motions.parliamentary_years_id')
        ->join('assemblies', 'assemblies.id', '=', 'motions.assemblies_id')
        ->join('sessions', 'sessions.id', '=', 'motions.sessions_id')
        ->join('order_of_the_day_summary_of_proceedings', 'order_of_the_day_summary_of_proceedings.id', '=', 'motions.order_of_the_day_summary_of_proceedings_id')
        ->join('members_directories', 'members_directories.id', '=', 'motions.members_directories_id')
        ->select('motions.*', 'parliamentary_years.name as parliamentary_years_name','assembly_tenures.fromdate','assembly_tenures.todate','sessions.fromdate as sessionsfromdate','sessions.todate as sessionstodate','order_of_the_day_summary_of_proceedings.sittingsno','assemblies.name as assemblyname','members_directories.name as membername')
        ->where('motions.lang',app()->getLocale())
        ->get();
        
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = ParliamentaryYears::all()->where('lang',app()->getLocale());
        $sessions = Sessions::all()->where('lang',app()->getLocale());
        $assemblies = Assembly::all()->where('lang',app()->getLocale());
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        $orderOfTheDaySummaryOfProceedings = OrderOfTheDaySummaryOfProceedings::all()->where('lang',app()->getLocale());
        // return $parliamentaryyears
        // dd($singleRow);
        return view('motions', compact('singleRow','allRows','assemblyTenure','parliamentaryYears','sessions','orderOfTheDaySummaryOfProceedings','membersDirectories','assemblies'));
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
            'sessions_id' => 'required',
            'order_of_the_day_summary_of_proceedings_id' => 'required',
            'members_directories_id' => 'required',
            'status' => 'required',
            'motiontype' => 'required',
            'motionno' => 'required',
            'title' => 'required',
            'typetabs' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = Motions::find($id);
        $table->assemblies_id = $request->assemblies_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->sessions_id = $request->sessions_id;
        $table->order_of_the_day_summary_of_proceedings_id = $request->order_of_the_day_summary_of_proceedings_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->status = $request->status;
        $table->motiontype = $request->motiontype;
        $table->motionno = $request->motionno;
        $table->title = $request->title;
        $table->typetabs = $request->typetabs;
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
        return redirect()->route('motions.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $table = Motions::find($id);
        $table->delete();
        return redirect()->route('motions.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
