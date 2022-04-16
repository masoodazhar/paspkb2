<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Message;
use App\Models\MembersDirectory;

class MessageController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:messages-list|messages-edit', ['only' => ['index','store']]);
         $this->middleware('permission:messages-edit', ['only' => ['edit','update']]);
     
    }

    function get_messages($locale){

        $allRows = DB::table('messages')
        ->join('members_directories', 'members_directories.id','messages.members_directories_id')  
        ->select('messages.*','members_directories.image','members_directories.name as membername')
        ->where('messages.lang', $locale)
        ->get();
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
        // $singleRow = Message::find(1);
        $singleRows = DB::table('messages')->where('lang', app()->getLocale())->where('msid',1)->get()->first();
        // dd($singleRow);
        $deputyRow = DB::table('messages')->where('lang', app()->getLocale())->where('msid',2)->get()->first();
        $memberDirectories = MembersDirectory::all()->where('lang', app()->getLocale());
        return view('messages', compact('singleRows','deputyRow','memberDirectories'));
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
            'members_directories_id' => 'required',
            'description' => 'required'
        ]);

        $table = new Message;
        $table->members_directories_id = $request->members_directories_id;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('messages.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRows = DB::table('messages')->where('lang', app()->getLocale())->where('msid',$id)->get()->first();
        $memberDirectories = MembersDirectory::all()->where('lang', app()->getLocale());
        return view('messages', compact('singleRows','memberDirectories'));
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
            'members_directories_id' => 'required',
        
        ]);

        if($request->description2){

            $table = Message::find($id);
            $table->members_directories_id = $request->members_directories_id;
            $table->description = $request->description2;
            $table->designation = $request->designation;

        }else{
            $table = Message::find($id);
            $table->members_directories_id = $request->members_directories_id;
            $table->description = $request->description;
            $table->designation = $request->designation;

        }

        $table->save();
        return redirect()->route('messages.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Message::find($id);
        $singleRow->delete();
        return redirect()->route('about.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
