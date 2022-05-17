<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoArchive;
use DB;
class VideoArchiveController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:faqs-list|faqs-create|faqs-edit|faqs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:faqs-create', ['only' => ['create','store']]);
         $this->middleware('permission:faqs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:faqs-delete', ['only' => ['destroy']]);
    }

    public function get_videoarchive($locale='en')
    {
        $allRows = DB::table('video_archives')->where('lang', $locale);
        return response()->json($allRows);
    }

    public function get_videoarchiveLimit($locale='en')
    {
        $allRows = DB::table('video_archives')->where('lang', $locale)->latest('id')->limit(4)->get();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $allRows = VideoArchive::all();
        return view('videoarchive', compact('allRows'));
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
            'file' => 'required',
            'description' => 'required'
        ]);

        $table = new VideoArchive;
        $table->name = $request->name;
        if($request->hasFile('file')){

            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('uploads'), $imageName);
            $table->file =  $imageName;

        }else{
            $table->file = $request->file;
        }
        $table->description = $request->description;
        $table->save();
        return redirect()->route('videoarchive.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($id)
    {
        $singleRow = VideoArchive::find($id);
        $allRows = VideoArchive::all();

        return view('videoarchive', compact('allRows','singleRow'));
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
            'name' => 'required',
            // 'file' => 'required',
            'description' => 'required'
        ]);

        $table = VideoArchive::find($id);
        $table->name = $request->name;
        if($request->hasFile('file')){

            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('uploads'), $imageName);
            $table->file =  $imageName;

        }else{
            $table->file = $table->file;
        }
        $table->description = $request->description;
        $table->save();
        return redirect()->route('videoarchive.index')->with(['success'=>'Data has been Updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = VideoArchive::find($id);
        $singleRow->delete();
        return redirect()->route('videoarchive.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
