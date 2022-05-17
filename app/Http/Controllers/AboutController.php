<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\About;

class AboutController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:about-list|about-create|about-edit|about-delete', ['only' => ['index','store']]);
         $this->middleware('permission:about-create', ['only' => ['create','store']]);
         $this->middleware('permission:about-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:about-delete', ['only' => ['destroy']]);
    }
    function get_about($locale=''){
        $allRows = DB::table('abouts')->where('lang', $locale)->get();
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
        $allRows = About::all()->where('lang', app()->getLocale());
        return view('about', compact('allRows'));
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
            'description' => 'required'
        ]);


        $table = new About;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('about.index')->with(['success'=>'Data has been Saved successfully']);
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

        // dd($id);
        $singleRow = About::find($id);
        $allRows = About::all()->where('lang', app()->getLocale());
        return view('about', compact('allRows','singleRow'));

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
            'name' => 'required',
            'description' => 'required'
        ]);

        $table = About::find($id);
        $table->name = $request->name;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('about.index',  app()->getLocale())->with(['success'=>'Data has been Updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = About::find($id);
        $singleRow->delete();
        return redirect()->route('about.index',  app()->getLocale())->with(['success'=>'Data has been Deleted successfully']);
    }
}
