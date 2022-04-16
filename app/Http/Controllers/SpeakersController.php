<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speakers;
use DB;
use App\Models\Assembly;

class SpeakersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:speakers-list|speakers-create|speakers-edit|speakers-delete', ['only' => ['index','store']]);
         $this->middleware('permission:speakers-create', ['only' => ['create','store']]);
         $this->middleware('permission:speakers-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:speakers-delete', ['only' => ['destroy']]);
    }

    public function get_speakersmain($locale='en')
    {
        $singleRow = DB::table('speakers_main')
        ->join('members_directories', 'members_directories.id','speakers_main.members_directories_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('speakers_main.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('speakers_main.lang', $locale)
        ->get()
        ->first();
        return response()->json($singleRow);
    }

    public function get_speakers($id=false, $locale='en')
    {
        if(is_numeric($id)){
            $allRows = DB::table('speakers')->where('id', $id)->where('lang',$locale)->get()->first();
        }else{
            $allRows = DB::table('speakers')->where('lang',$locale)->get();
        }
        return response()->json($allRows);
    }

    public function get_speakersformer($locale='en')
    {
        $singleRow = DB::table('speakers_main')
        ->select('members_directories_ids')
        ->where('lang',$locale)
        ->get()
        ->first();
        $ids = json_decode($singleRow->members_directories_ids);

        $members = DB::table('members_directories')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('members_directories.*','assembly_tenures.*')
        ->whereIn('members_directories.id',$ids)
        ->where('members_directories.lang',$locale)
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
        $allRows = Speakers::all()->where('lang', app()->getLocale());
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        

        $singleRowMain = DB::table('speakers_main')->select('*')->where('lang',app()->getLocale())->where('spid',1)->get()->first();
        
        $memberDirectories = DB::table('members_directories')->where('lang', app()->getLocale())->get();
        // dd($singleRowMain);
        return view('speakers', compact('assembly','allRows','singleRowMain','memberDirectories'));
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
        $table = new Speakers;
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'image_pdf_link' => 'required'
        ]);
        
        $table->name = $request->name;
        $table->date = $request->date;
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
        return redirect()->route('speakers.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRowMain = DB::table('speakers_main')->select('*')->where('lang',app()->getLocale())->where('spid',1)->first();
        
        $memberDirectories = DB::table('members_directories')->where('lang', app()->getLocale())->get();
        $assembly = Assembly::all()->where('lang', app()->getLocale());
        $allRows = Speakers::all()->where('lang', app()->getLocale());
        $singleRow = Speakers::find($id); 
        return view('speakers', compact('assembly','allRows','singleRow','singleRowMain','memberDirectories'));
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
    
            DB::update('update speakers_main set 
            members_directories_id=?,
            members_directories_ids=?,
            speakermessage=?,
            speakersrole=?
            where id = ?',
            [$request->members_directories_id,json_encode($request->members_directories_ids),$request->speakermessage,$request->speakersrole,$id]);
                
            // return ;
            // dd($request->members_directories_ids);
                
        }else{
            $request->validate([
                'name' => 'required',
                'date' => 'required',
                'type' => 'required',
                'image_pdf_link' => 'required'
            ]);      
            $table = Speakers::find($id);
            $table->name = $request->name;
            $table->date = $request->date;
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
        } 
    return redirect()->route('speakers.index')->with(['success'=>'Data has been Updated successfully']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Speakers::find($id);
        $singleRow->delete();
        return redirect()->route('speakers.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
