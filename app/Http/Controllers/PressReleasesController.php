<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PressReleases;
use App\Models\DeputySpeaker;
use App\Models\Speakers;
use DB;
class PressReleasesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:press-releases-list|press-releases-create|press-releases-edit|press-releases-delete', ['only' => ['index','store']]);
         $this->middleware('permission:press-releases-create', ['only' => ['create','store']]);
         $this->middleware('permission:press-releases-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:press-releases-delete', ['only' => ['destroy']]);
    } 

    public function get_pressreleases($page, $locale='en'){
        $allRows = DB::table('press_releases')
        ->select('*')
        ->where('page', $page)
        ->where('lang', $locale)
        ->get();
        return response()->json($allRows);
    }

    function speakerNews($locale='en'){
        $allRows = DB::table('Speakers')->where('lang', $locale)->get();

        return response()->json($allRows);
    }

    function deputyspeakerNews($locale='en'){
        $allRows = DB::table('deputy_speakers')->where('lang', $locale)->get();

        return response()->json($allRows);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $allRows = PressReleases::all()->where('lang',app()->getLocale());
        return view('pressreleases', compact('allRows'));
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
            'name' => 'required',
            'date' => 'required',
            'type'=>  'required',
            'page'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = new PressReleases;
        $table->name = $request->name;
        $table->date = $request->date;
        $table->type = $request->type;
        $table->page = $request->page;
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
        if($request->hasFile('image')){
                     
                $imageName = time().'file.'.$request->image->extension();       
                $request->image->move(public_path('uploads'), $imageName);
                $table->image =  $imageName;             
           
        }else{
            $table->image = '-';
        }
        $table->save();
        return redirect()->route('pressreleases.index')->with(['success'=>'Data has been Saved successfully']);
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
        
        $singleRow = PressReleases::find($id); 
        $allRows = PressReleases::all()->where('lang',app()->getLocale());

        return view('pressreleases', compact('allRows','singleRow'));
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
            'name' => 'required',
            'date' => 'required',
            'type'=>  'required',
            'page'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = PressReleases::find($id);
        $table->name = $request->name;
        $table->date = $request->date;
        $table->type = $request->type;
        $table->page = $request->page;
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
        if($request->hasFile('image')){
                     
                $imageName = time().'file.'.$request->image->extension();       
                $request->image->move(public_path('uploads'), $imageName);
                $table->image =  $imageName;             
           
        }else{
            $table->image = $request->image;
        }
        $table->save();
        return redirect()->route('pressreleases.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = PressReleases::find($id);
        $singleRow->delete();
        return redirect()->route('pressreleases.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
