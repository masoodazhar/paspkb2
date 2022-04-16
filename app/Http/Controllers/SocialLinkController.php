<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\SocialLink;
class SocialLinkController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:social-links-list|social-links-edit', ['only' => ['index','store']]);
         $this->middleware('permission:social-links-edit', ['only' => ['edit','update']]);
     
    }

    function get_sociallink(){

        $allRows = SocialLink::find(1);
        return json_encode($allRows);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singleRow = SocialLink::find(1);
        // dd($singleRow);
        return view('sociallink', compact('singleRow'));
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
            'facebook' => 'required',
            'youtube' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'google' => 'required'
        ]);
           

        $table = new SocialLink;
        $table->facebook = $request->facebook;
        $table->youtube = $request->youtube;
        $table->twitter = $request->twitter;
        $table->linkedin = $request->linkedin;
        $table->google = $request->google;
        $table->save();
        return redirect()->route('sociallink.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = About::find($id); 
        $allRows = About::all();
        return view('about', compact('allRows','singleRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
                'facebook' => 'required',
                'youtube' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
                'google' => 'required',
                'calendar_year' => 'required',
           
        ]);

        $table = SocialLink::find(1);
        $table->facebook = $request->facebook;
        $table->youtube = $request->youtube;
        $table->twitter = $request->twitter;
        $table->linkedin = $request->linkedin;
        $table->google = $request->google;
        $table->calendar_year = $request->calendar_year;
        $table->save();
        return redirect()->route('sociallink', app()->getLocale())->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
