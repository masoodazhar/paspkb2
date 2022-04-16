<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StandingCommitteesCategory;
use DB;
class StandingCommitteesCategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allRows = StandingCommitteesCategory::all();
        $allRows = DB::table('standing_committees_categories')
        ->leftJoin('standingcommitteesmember', 'standingcommitteesmember.acc_id', '=', 'standing_committees_categories.id')
        ->select('standing_committees_categories.*', 'standingcommitteesmember.members_directories_id as member')
        ->where('standing_committees_categories.lang',app()->getLocale())
        ->get();
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        return view('standingcommitteescategory', compact('allRows','memberDirectories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // s
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new StandingCommitteesCategory;
        $request->validate([
            'category' => 'required',
        ]);
        
        $table->category = $request->category;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('standingcommitteescategory.index')->with(['success'=>'Data has been Saved successfully']);
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
        // $allRows = StandingCommitteesCategory::all()->where('lang',app()->getLocale());
        $allRows = DB::table('standing_committees_categories')
        ->leftJoin('standingcommitteesmember', 'standingcommitteesmember.acc_id', '=', 'standing_committees_categories.id')
        ->select('standing_committees_categories.*', 'standingcommitteesmember.members_directories_id as member')
        ->where('standing_committees_categories.lang',app()->getLocale())
        ->get();
        $singleRow = StandingCommitteesCategory::find($id); 
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        
        return view('standingcommitteescategory', compact('allRows','singleRow','memberDirectories'));
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
            'category' => 'required'
        ]);
        
        $table = StandingCommitteesCategory::find($id);
        $table->category = $request->category;
        $table->save();
        return redirect()->route('standingcommitteescategory.index')->with(['success'=>'Data has been Updated successfully']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = StandingCommitteesCategory::find($id);
        $singleRow->delete();
        return redirect()->route('standingcommitteescategory.index')->with(['success'=>'Data has been Deleted successfully']);
    }


  
    
}
