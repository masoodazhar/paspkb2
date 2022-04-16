<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use DB;

class QuestionsController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:questions-list|questions-create|questions-edit|questions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:questions-create', ['only' => ['create','store']]);
         $this->middleware('permission:questions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:questions-delete', ['only' => ['destroy']]);
    }  

    public function get_questions($id=false, $locale='en')
    {
        if(is_numeric($id)){
            $allRows =  DB::table('questions')
            ->join('sessions', 'sessions.id', '=', 'questions.sessions_id')
            ->join('members_directories', 'members_directories.id', '=', 'questions.members_directories_id')
            ->select('questions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername')
            ->where('questions.id',$id)
            ->where('questions.lang',$locale)
            ->first();
        }else{
            $allRows =  DB::table('questions')
            ->join('sessions', 'sessions.id', '=', 'questions.sessions_id')
            ->join('members_directories', 'members_directories.id', '=', 'questions.members_directories_id')
            ->select('questions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername')
            ->where('questions.lang',$locale)
            ->get();
        }
        
        return response()->json($allRows);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows =  DB::table('questions')
        ->join('sessions', 'sessions.id', '=', 'questions.sessions_id')
        ->join('members_directories', 'members_directories.id', '=', 'questions.members_directories_id')
        ->select('questions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername')
        ->where('questions.lang',app()->getLocale())
        ->get();

        $sessions = DB::table('sessions')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
       ->select('sessions.*','main_sessions.sessionname')
       ->where('sessions.lang',app()->getLocale())
        ->get();
        $membersDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        return view('questions', compact('allRows','sessions','membersDirectories'));
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
            'date' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'status' => 'required',
            'image_pdf_link' => 'required'
        ]);
           
        $table = new Questions;
        $table->sessions_id = $request->sessions_id;
        $table->members_directories_id = $request->members_directories_id;
        
        $table->date = $request->date;
        $table->subject = $request->subject;
        $table->department = $request->department;
        $table->status = $request->status;
        $table->type = $request->type;
        $table->lang =  app()->getLocale();

        if($request->number = ''){
            $table->number = '-';
        }else{
            $table->number = $request->number;
        }

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
        return redirect()->route('questions.index')->with(['success'=>'Data has been Saved successfully']);
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

        $singleRow = Questions::find($id); 
        $allRows =  DB::table('questions')
        ->join('sessions', 'sessions.id', '=', 'questions.sessions_id')
        ->join('members_directories', 'members_directories.id', '=', 'questions.members_directories_id')
        ->select('questions.*', 'sessions.fromdate','sessions.todate','members_directories.image','members_directories.name as membername')
        ->where('questions.lang',app()->getLocale())
        ->get();
        return view('questions', compact('allRows','singleRow','sessions','membersDirectories'));
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
            'number' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'status' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = Questions::find($id);
        $table->sessions_id = $request->sessions_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->number = $request->number;
        $table->date = $request->date;
        $table->subject = $request->subject;
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
        return redirect()->route('questions.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Questions::find($id);
        $singleRow->delete();
        return redirect()->route('questions.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
