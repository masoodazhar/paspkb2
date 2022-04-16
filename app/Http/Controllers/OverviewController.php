<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overview;
use DB;
class OverviewController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:overview-list|overview-edit', ['only' => ['index','store']]);
         $this->middleware('permission:overview-edit', ['only' => ['edit','update']]);
    }

    public function get_overview($locale='en')
    {
        $allRows = DB::table('overviews')->where('lang', $locale)->where('overid',1)->get()->first();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singleRow = Overview::find(1); 
        $singleRows = DB::table('overviews')->where('lang', app()->getLocale())->where('overid',1)->get()->first();
        
        return view('overview', compact('singleRows'));
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
       
        // $singleRow = Overview::find($id); 
        $singleRows = DB::table('overviews')->where('lang', app()->getLocale())->where('overid',1)->get()->first();
        return view('overview', compact('singleRows'));
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
            'description' => 'required'
        ]);

        $table = Overview::find($id);
        $table->description = $request->description;
        $table->save();
        return redirect()->route('overview.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Overview::find($id);
        $singleRow->delete();
        return redirect()->route('about.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
