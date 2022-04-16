<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommitteeRules;
use DB;
class CommitteeRulesController extends Controller
{ 
    function __construct()
    {
         $this->middleware('permission:committee-rules-list|committee-rules-create|committee-rules-edit|committee-rules-delete', ['only' => ['index','store']]);
         $this->middleware('permission:committee-rules-create', ['only' => ['create','store']]);
         $this->middleware('permission:committee-rules-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:committee-rules-delete', ['only' => ['destroy']]);
    } 
    public function get_committeerules($locale='en')
    {
        $CommitteeRules = DB::table('committee_rules')->select('*')->where('lang',$locale)->where('crid',1)->first();
        return response()->json($CommitteeRules);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $singleRow = CommitteeRules::find(1); 
        $singleRows = DB::table('committee_rules')->select('*')->where('lang',app()->getLocale())->where('crid',1)->first();
        return view('committeerules', compact('singleRows'));
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
       
        // $singleRow = CommitteeRules::find($id);
        $singleRows = DB::table('committee_rules')->select('*')->where('lang',app()->getLocale())->where('crid',1)->first(); 
        return view('committeerules', compact('singleRows'));
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

        $table = CommitteeRules::find($id);
        $table->description = $request->description;
        $table->save();
        return redirect()->route('committeerules.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = CommitteeRules::find($id);
        $singleRow->delete();
        return redirect()->route('committeerules.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
