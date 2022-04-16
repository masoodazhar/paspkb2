<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResolutionsPassed;
use App\Models\Sessions;
use DB;

class ResolutionsPassedController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:call-attention-list|call-attention-create|call-attention-edit|call-attention-delete', ['only' => ['index','store']]);
         $this->middleware('permission:call-attention-create', ['only' => ['create','store']]);
         $this->middleware('permission:call-attention-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:call-attention-delete', ['only' => ['destroy']]);
    }  

    public function get_resolutionspassed($tenureid, $locale='en')
    {       

            $allmainSessions =  DB::table('resolutions_passeds')
            ->join('sessions', 'sessions.id', '=', 'resolutions_passeds.sessions_id')
            ->join('assembly_tenures as at', 'at.id', '=', 'resolutions_passeds.assembly_tenures_id')
            ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
            ->select('main_sessions.*','resolutions_passeds.status','resolutions_passeds.department')
            ->where('resolutions_passeds.assembly_tenures_id',$tenureid)
            ->where('resolutions_passeds.lang',$locale)
            ->get();
            $spg = $allmainSessions->unique('sessionname');
            $allmainSessions = array_slice($spg->values()->all(),0,1000, true);
    
            // dd($allmainSessions);
            $allRows = [];
            foreach($allmainSessions as $msession){            
                $sessions = DB::table('resolutions_passeds as ord')
                ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
                ->select('sessions.*','ord.id as rsid','ord.status','ord.type','ord.date as rsdate','ord.image_pdf_link')
                // ->where('ord.sittingstype',$page)
                ->where('ord.lang',$locale)
                ->where('sessions.main_sessions_id', $msession->id)->get();
                $sess = array(
                    'department'=>$msession->department,
                    'sessionname'=>$msession->sessionname,
                    'listofsessions'=>$sessions
                );  
                array_push($allRows,$sess);
                // echo $msession->sessionname;
            }

        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_resolutionspasseddetail($id, $locale='en'){
        $allmainSessions =  DB::table('resolutions_passeds')
        ->join('sessions', 'sessions.id', '=', 'resolutions_passeds.sessions_id')
        ->join('assembly_tenures as at', 'at.id', '=', 'resolutions_passeds.assembly_tenures_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('main_sessions.*','resolutions_passeds.status','resolutions_passeds.department','resolutions_passeds.type','resolutions_passeds.image_pdf_link')
        ->where('resolutions_passeds.id',$id)
        ->where('resolutions_passeds.lang',$locale)
        ->first();

        return response()->json($allmainSessions);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $allRows =  DB::table('resolutions_passeds')
        ->join('sessions', 'sessions.id', '=', 'resolutions_passeds.sessions_id')
        ->join('assembly_tenures as at', 'at.id', '=', 'resolutions_passeds.assembly_tenures_id')
        ->select('resolutions_passeds.*', 'sessions.fromdate','sessions.todate','at.fromdate as atfromdate','at.todate as attodate')
        ->where('resolutions_passeds.lang',app()->getLocale())
        ->get();
        $sessions = Sessions::all()->where('lang',app()->getLocale());
        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->get();
        return view('resolutionspassed', compact('allRows','sessions','assemblyTenures'));
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
            'number' => 'required',
            'title' => 'required',
            'date' => 'required',
            'status' => 'required',
            'department' => 'required',
            'assembly_tenures_id' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);
           

        $table = new ResolutionsPassed;
        $table->sessions_id = $request->sessions_id;
        $table->type = $request->type;
        $table->number = $request->number;
        $table->title = $request->title;
        $table->restype = '-';
        $table->date = $request->date;
        $table->department = $request->department;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->status = $request->status;
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
        return redirect()->route('resolutionspassed.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = ResolutionsPassed::find($id); 
        $sessions = Sessions::all()->where('lang',app()->getLocale());
        $assemblyTenures = DB::table('assembly_tenures')->where('lang',app()->getLocale())->get();
        $allRows =  DB::table('resolutions_passeds')
        ->join('sessions', 'sessions.id', '=', 'resolutions_passeds.sessions_id')
        ->join('assembly_tenures as at', 'at.id', '=', 'resolutions_passeds.assembly_tenures_id')
        ->select('resolutions_passeds.*', 'sessions.fromdate','sessions.todate','at.fromdate as atfromdate','at.todate as attodate')
        ->where('resolutions_passeds.lang',app()->getLocale())
        ->get();
        return view('resolutionspassed', compact('allRows','singleRow','sessions','assemblyTenures'));
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
            'number' => 'required',
            'title' => 'required',
            'date' => 'required',
            'status' => 'required',
            'assembly_tenures_id' => 'required',
            'department' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = ResolutionsPassed::find($id);
        $table->sessions_id = $request->sessions_id;
        $table->type = $request->type;
        $table->number = $request->number;
        $table->title = $request->title;
        $table->restype = '-';
        $table->date = $request->date;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->department = $request->department;
        $table->status = $request->status;
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
            $table->image_pdf_link = $request->image_pdf_link;
        }
        $table->save();
        return redirect()->route('resolutionspassed.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = ResolutionsPassed::find($id);
        $singleRow->delete();
        return redirect()->route('resolutionspassed.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
