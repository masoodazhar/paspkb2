<?php

namespace App\Http\Controllers;

use App\Models\ElectionController;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\MembersDirectory;
use App\Models\AssemblyTenure;
use DB;

class ElectionControllerController extends Controller
{
    public function get_electionCat($category=false, $locale='en'){
        
        $allRows = DB::table('elections')
        ->join('members_directories', 'members_directories.id','elections.members_directories_name_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'elections.assembly_tenures_id')
        ->select('elections.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('elections.assembly_tenures_id',$category)
        ->where('elections.lang', $locale)
        ->get();
    
    return response()->json($allRows);
}
public function get_election($tenuresid=false, $locale='en')
{
    if($tenuresid){
        $allRows = DB::table('elections')
        // ->join('members_directories', 'members_directories.id',' in  (elections.members_directories_name_id ,elections.members_directories_current_id)')  
        ->join('members_directories as mem1', 'mem1.id','elections.members_directories_current_id')  
        ->join('members_directories as mem2', 'mem2.id','elections.members_directories_name_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'elections.assembly_tenures_id')
        ->select('elections.*','mem1.mian_aothdate','mem1.name','mem1.constituency','mem2.name as currentmembername','mem2.id as currentmemberid','mem1.id as memberid','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('elections.assembly_tenures_id',$tenuresid)
        ->where('elections.lang', $locale)
        ->get();
    }else{
        $allRows = DB::table('elections')
        ->join('members_directories', 'members_directories.id','elections.members_directories_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'elections.assembly_tenures_id')
        ->select('elections.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('elections.lang', $locale)
        ->get();
    }
    
    return response()->json($allRows);
}
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $allRows = DB::table('elections')
    ->join('members_directories as m1', 'm1.id', '=', 'elections.members_directories_name_id')
    ->join('members_directories as m2', 'm2.id', '=', 'elections.members_directories_current_id')
    ->join('assembly_tenures', 'assembly_tenures.id', '=', 'elections.assembly_tenures_id')
    ->select('elections.*', 'm1.name as m1name','m2.name as m2name','assembly_tenures.fromdate','assembly_tenures.todate')
    ->where('elections.lang',app()->getLocale())
    ->get();
    $members = MembersDirectory::all()->where('lang',app()->getLocale());
    $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();

    return view('election', compact('allRows','members','assemblyTenure'));
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
        'members_directories_name_id' => 'required',
        'members_directories_current_id' => 'required',
        'assembly_tenures_id' => 'required',
        'elfromdate' => 'required',
        'eltodate' => 'required',
        'reasion' => 'required',
        'aothdate' => 'required',
        'member_status' => 'required',
    ]);
       

    $table = new Election;
    $table->members_directories_name_id = $request->members_directories_name_id;
    $table->members_directories_current_id = $request->members_directories_current_id;
    $table->assembly_tenures_id = $request->assembly_tenures_id;
    $table->elfromdate = $request->elfromdate;
    $table->eltodate = $request->eltodate;
    $table->reasion = $request->reasion;
    $table->aothdate = $request->aothdate;
    $table->member_status = $request->member_status;
    $table->lang = app()->getLocale();
    $table->save();
    return redirect()->route('elections.index')->with(['success'=>'Data has been Saved successfully']);
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
   
    $singleRow = Election::find($id); 
    $allRows = DB::table('elections')
    ->join('members_directories as m1', 'm1.id', '=', 'elections.members_directories_name_id')
    ->join('members_directories as m2', 'm2.id', '=', 'elections.members_directories_current_id')
    ->join('assembly_tenures', 'assembly_tenures.id', '=', 'elections.assembly_tenures_id')
    ->select('elections.*', 'm1.name as m1name','m2.name as m2name','assembly_tenures.fromdate','assembly_tenures.todate')
    ->where('elections.lang',app()->getLocale())
    ->get();
    $members = MembersDirectory::all()->where('lang',app()->getLocale());
    $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();

    return view('election', compact('allRows','members','assemblyTenure','singleRow'));
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
        'members_directories_name_id' => 'required',
        'members_directories_current_id' => 'required',
        'assembly_tenures_id' => 'required',
        'elfromdate' => 'required',
        'eltodate' => 'required',
        'reasion' => 'required',
        'aothdate' => 'required'
    ]);

    $table = Election::find($id);  
    $table->members_directories_name_id = $request->members_directories_name_id;
    $table->members_directories_current_id = $request->members_directories_current_id;
    $table->assembly_tenures_id = $request->assembly_tenures_id;
    $table->elfromdate = $request->elfromdate;
    $table->eltodate = $request->eltodate;
    $table->reasion = $request->reasion;
    $table->aothdate = $request->aothdate;
    $table->member_status = $request->member_status;
    $table->save();
    return redirect()->route('elections.index')->with(['success'=>'Data has been Updated successfully']);
    
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($ignore,$id)
{
    $singleRow = Election::find($id);
    $singleRow->delete();
    return redirect()->route('elections.index')->with(['success'=>'Data has been Deleted successfully']);
}
}
