<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebCastLiveVideoAudio;
use DB;
class WebCastLiveVideoAudioController extends Controller
{
    public function get_webcastlivevideoaudio($locale='en')
    {
        $allRows = DB::table('web_cast_live_video_audio')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    public function get_webcastlivevideoaudiolast($locale='en')
    {
        $allRows = DB::table('web_cast_live_video_audio')->where('lang', $locale)->latest('id')->first();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $allRows = WebCastLiveVideoAudio::all();
        return view('webcastlivevideoaudio', compact('allRows'));
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
            'link' => 'required',
            'date' => 'required'
        ]);

        $table = new WebCastLiveVideoAudio;
        $table->name = $request->name;
        $table->link = $request->link;
        $table->date = $request->date;
        $table->save();
        return redirect()->route('webcastlivevideoaudio.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = WebCastLiveVideoAudio::find($id); 
        $allRows = WebCastLiveVideoAudio::all();

        return view('webcastlivevideoaudio', compact('allRows','singleRow'));
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
            'link' => 'required',
            'date' => 'required'
        ]);

        $table = WebCastLiveVideoAudio::find($id);
        $table->name = $request->name;
        $table->link = $request->link;
        $table->date = $request->date;
        $table->save();
        return redirect()->route('webcastlivevideoaudio.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleRow = WebCastLiveVideoAudio::find($id);
        $singleRow->delete();
        return redirect()->route('webcastlivevideoaudio.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
