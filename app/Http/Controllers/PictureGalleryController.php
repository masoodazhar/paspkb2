<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PictureGallery;
use DB;
class PictureGalleryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tenders-list|tenders-create|tenders-edit|tenders-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tenders-create', ['only' => ['create','store']]);
         $this->middleware('permission:tenders-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tenders-delete', ['only' => ['destroy']]);
    } 
    

    public function get_picturegallery($locale='en')
    {
        $allRows = DB::table('picture_galleries')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    public function get_picturegallery_speaker($locale='en')
    {
        $allRows = DB::table('picture_galleries')
        ->where('page', 'Speaker')
        ->where('lang', $locale)
        ->get();
        return response()->json($allRows);
    }

    public function get_picturegallery_deputy_speaker($locale='en')
    {
        $allRows = DB::table('picture_galleries')
        ->where('page', 'Deputy Speaker')
        ->where('lang', $locale)
        ->get();
        return response()->json($allRows);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {   
        $allRows = PictureGallery::all()->where('lang',app()->getLocale());
        return view('picturegallery', compact('allRows'));
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
            'date' => 'required',
            'image' => 'required',
            'page' => 'required',
        ]);

        $table = new PictureGallery;
        $table->date = $request->date;
        $table->title = $request->title;
        $table->page = $request->page;
        $table->description = $request->description;
        $table->lang = app()->getLocale();

        if($request->hasFile('image')){
            
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('uploads'), $imageName);
            $table->image = $imageName;
          
        }else{
            $table->image = $request->image;
        }
        $table->save();
        return redirect()->route('picturegallery.index')->with(['success'=>'Data has been Saved successfully']);
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
        
        $singleRow = PictureGallery::find($id); 
        $allRows = PictureGallery::all()->where('lang',app()->getLocale());

        return view('picturegallery', compact('allRows','singleRow'));
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
            'date' => 'required',
            'title' => 'required',
            'page' => 'required',
            'description' => 'required'
        ]);

        $table = PictureGallery::find($id);
        $table->date = $request->date;
        $table->title = $request->title;
        $table->page = $request->page;
        $table->description = $request->description;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('uploads'), $imageName);
            $table->image = $imageName;
        }else{
            $table->image = $table->image;
        }
        $table->save();
        return redirect()->route('picturegallery.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $ignore)
    {
        $singleRow = PictureGallery::find($id);
        $singleRow->delete();
        return redirect()->route('picturegallery.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
