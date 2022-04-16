<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeputySpeaker;
use DB;
use App\Models\Assembly;
class DeputySpeakerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:deputy-speaker-list|deputy-speaker-create|deputy-speaker-edit|deputy-speaker-delete', ['only' => ['index','store']]);
         $this->middleware('permission:deputy-speaker-create', ['only' => ['create','store']]);
         $this->middleware('permission:deputy-speaker-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:deputy-speaker-delete', ['only' => ['destroy']]);
    }

    public function get_deputyspeakermain($locale='en')
    {
        $singleRow = DB::table('deputy_speakers_main')
        ->join('members_directories', 'members_directories.id','deputy_speakers_main.members_directories_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('deputy_speakers_main.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('deputy_speakers_main.lang', $locale)
        ->get()
        ->first();
        return response()->json($singleRow);
    }

    public function get_deputyspeaker($id=false, $locale='en')
    {
        if(is_numeric($id)){
            $allRows = DB::table('deputy_speakers')->where('lang', $locale)->where('id', $id)->get()->first();
        }else{
            $allRows = DB::table('deputy_speakers')->where('lang', $locale)->get();
        }
        return response()->json($allRows);
    }

    public function get_deputyspeakerformer($locale='en')
    {
        $singleRow = DB::table('deputy_speakers_main')
        ->select('members_directories_ids')
        ->where('deputy_speakers_main.lang', $locale)
        ->get()
        ->first();
        $ids = json_decode($singleRow->members_directories_ids);
        
        $members = DB::table('members_directories')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('members_directories.*','assembly_tenures.*')
        ->whereIn('members_directories.id',$ids)
        ->where('members_directories.lang', $locale)
        ->get();
        return response()->json($members);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = DeputySpeaker::all()->where('lang',app()->getLocale());

        $singleRowMain = DB::table('deputy_speakers_main')->select('*')->where('lang',app()->getLocale())->where('dspid',1)->first();
        $memberDirectories = DB::table('members_directories')->get()->where('lang',app()->getLocale());
        $assembly = Assembly::all()->where('lang',app()->getLocale());
        return view('deputyspeaker', compact('allRows','singleRowMain','memberDirectories','assembly'));
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
        $table = new DeputySpeaker;
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'image_pdf_link' => 'required',
            // 'members_directories_ids[]'=> 'required'
        ]);
        
        $table->name = $request->name;
        $table->type = $request->type;
        $table->date = $request->date;
        $table->lang = app()->getLocale();

        // $table->assembly_id = $request->assembly_id;
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
        return redirect()->route('deputyspeaker.index')->with(['success'=>'Data has been Saved successfully']);
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
        $allRows = DeputySpeaker::all()->where('lang',app()->getLocale());

        
        $singleRowMain = DB::table('deputy_speakers_main')->select('*')->where('lang',app()->getLocale())->where('dspid',1)->first();
        $memberDirectories = DB::table('members_directories')->get();
        
        $assembly = Assembly::all()->where('lang',app()->getLocale());
        $allRows = DeputySpeaker::all()->where('lang',app()->getLocale());
        $singleRow = DeputySpeaker::find($id); 
        return view('deputyspeaker', compact('assembly','allRows','singleRow','singleRowMain','memberDirectories'));
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
        if($request->check=='true'){
            $request->validate([
                'members_directories_id' => 'required'
            ]);
    
            DB::update('update deputy_speakers_main set 
            members_directories_id=?,
            members_directories_ids=?,
            speakermessage=?,
            speakersrole=?
            where id = ?',
            [$request->members_directories_id,json_encode($request->members_directories_ids),$request->speakermessage,$request->speakersrole,$id]);
        }else{
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'date' => 'required',
                'assembly_id' => 'required',
                'image_pdf_link' => 'required'
            ]);
            
            $table = DeputySpeaker::find($id);
            $table->name = $request->name;
            $table->type = $request->type;
            $table->date = $request->date;
            $table->assembly_id = $request->assembly_id;
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
        } 
    return redirect()->route('deputyspeaker.index')->with(['success'=>'Data has been Updated successfully']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = DeputySpeaker::find($id);
        $singleRow->delete();
        return redirect()->route('deputyspeaker.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
