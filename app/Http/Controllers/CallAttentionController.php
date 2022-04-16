<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallAttention;
use DB;

class CallAttentionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:call-attention-list|call-attention-create|call-attention-edit|call-attention-delete', ['only' => ['index','store']]);
         $this->middleware('permission:call-attention-create', ['only' => ['create','store']]);
         $this->middleware('permission:call-attention-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:call-attention-delete', ['only' => ['destroy']]);
    }  
    public function get_callattention($id=false, $locale='en')
    {
        if(is_numeric($id)){
            $allRows =  DB::table('call_attentions')
            ->join('sessions', 'sessions.id', '=', 'call_attentions.sessions_id')
            ->join('members_directories', 'members_directories.id', '=', 'call_attentions.members_directories_id')
            ->join('parliamentary_years', 'parliamentary_years.id', '=', 'call_attentions.parliamentary_years_id')
            ->select('call_attentions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername')
            ->where('call_attentions.id',$id)
            ->where('call_attentions.lang',$locale)
            ->first();
        }else{
            $allRows =  DB::table('call_attentions')
            ->join('sessions', 'sessions.id', '=', 'call_attentions.sessions_id')
            ->join('members_directories', 'members_directories.id', '=', 'call_attentions.members_directories_id')
            ->join('parliamentary_years', 'parliamentary_years.id', '=', 'call_attentions.parliamentary_years_id')
            ->select('call_attentions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername','parliamentary_years.name as pyname')
            ->where('call_attentions.lang',$locale)
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
        $allRows =  DB::table('call_attentions')
        ->join('sessions', 'sessions.id', '=', 'call_attentions.sessions_id')
        ->join('members_directories', 'members_directories.id', '=', 'call_attentions.members_directories_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'call_attentions.parliamentary_years_id')
        ->select('call_attentions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername','parliamentary_years.name as pyname')
        ->where('call_attentions.lang',app()->getLocale())
        ->get();

        $sessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname')
       ->where('sessions.lang',app()->getLocale())
        ->get();
        $membersDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();
        return view('callattention', compact('allRows','sessions','membersDirectories','parliamentaryYears'));
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
            'members_directories_id' => 'required',
            'parliamentary_years_id' => 'required',
            'number' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'status' => 'required',
            'description' => 'required'
        ]);
           
        $table = new CallAttention;
        $table->sessions_id = $request->sessions_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->number = $request->number;
        $table->date = $request->date;
        $table->subject = $request->subject;
        $table->department = $request->department;
        $table->status = $request->status;
        $table->description = $request->description;
        $table->lang=app()->getLocale();
        $table->save();
        return redirect()->route('callattention.index')->with(['success'=>'Data has been Saved successfully']);
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
        $membersDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        $parliamentaryYears = DB::table('parliamentary_years')->where('lang',app()->getLocale())->get();

        $singleRow = CallAttention::find($id); 
        $allRows =  DB::table('call_attentions')
        ->join('sessions', 'sessions.id', '=', 'call_attentions.sessions_id')
        ->join('members_directories', 'members_directories.id', '=', 'call_attentions.members_directories_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'call_attentions.parliamentary_years_id')
        ->select('call_attentions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername','parliamentary_years.name as pyname')
        ->where('call_attentions.lang',app()->getLocale())
        ->get();
        return view('callattention', compact('allRows','singleRow','sessions','membersDirectories','parliamentaryYears'));
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
            'members_directories_id' => 'required',
            'parliamentary_years_id' => 'required',
            'number' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'status' => 'required',
            'description' => 'required'
        ]);

        $table = CallAttention::find($id);
        $table->sessions_id = $request->sessions_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->parliamentary_years_id = $request->parliamentary_years_id;
        $table->number = $request->number;
        $table->date = $request->date;
        $table->subject = $request->subject;
        $table->department = $request->department;
        $table->status = $request->status;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('callattention.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = CallAttention::find($id);
        $singleRow->delete();
        return redirect()->route('callattention.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
