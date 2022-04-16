<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabinetComposition;
use App\Models\MembersDirectory;
use App\Models\AssemblyTenure;
use DB;

class CabinetCompositionController extends Controller
{
    public function get_cabinetcompositionCat($category=false, $locale='en'){
        
            $allRows = DB::table('cabinet_compositions')
            ->join('members_directories', 'members_directories.id','cabinet_compositions.members_directories_id')  
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'cabinet_compositions.assembly_tenures_id')
            ->select('cabinet_compositions.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
            ->where('cabinet_compositions.assembly_tenures_id',$category)
            ->where('cabinet_compositions.lang', $locale)
            ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    public function get_cabinetcomposition($tenuresid=false, $locale='en')
    {
        if($tenuresid){
            $allRows = DB::table('cabinet_compositions')
            ->join('members_directories', 'members_directories.id','cabinet_compositions.members_directories_id')  
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'cabinet_compositions.assembly_tenures_id')
            ->select('cabinet_compositions.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
            ->where('cabinet_compositions.assembly_tenures_id',$tenuresid)
            ->where('cabinet_compositions.lang', $locale)
            ->get();
        }else{
            $allRows = DB::table('cabinet_compositions')
            ->join('members_directories', 'members_directories.id','cabinet_compositions.members_directories_id')  
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'cabinet_compositions.assembly_tenures_id')
            ->select('cabinet_compositions.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
            ->where('cabinet_compositions.lang', $locale)
            ->get();
        }
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
        $allRows = DB::table('cabinet_compositions')
        ->join('members_directories', 'members_directories.id', '=', 'cabinet_compositions.members_directories_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'cabinet_compositions.assembly_tenures_id')
        ->select('cabinet_compositions.*', 'members_directories.name as membername','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('cabinet_compositions.lang', app()->getLocale())
        ->get();
        $members = MembersDirectory::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();

        return view('cabinetcomposition', compact('allRows','members','assemblyTenure'));
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
            'members_directories_id' => 'required',
            'assembly_tenures_id' => 'required',
            'category' => 'required',
            'tabs' => 'required',
            'cfromdate' => 'required',
            'ctodate' => 'required',
            'description' => 'required'
        ]);
           

        $table = new CabinetComposition;
        $table->members_directories_id = $request->members_directories_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->category = $request->category;
        $table->tabs = $request->tabs;
        $table->cfromdate = $request->cfromdate;
        $table->ctodate = $request->ctodate;
        // $table->leaderofthehouse = $request->leaderofthehouse;
        // $table->leaderofopposition = $request->leaderofopposition;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('cabinetcomposition.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = CabinetComposition::find($id); 
        $allRows = DB::table('cabinet_compositions')
        ->join('members_directories', 'members_directories.id', '=', 'cabinet_compositions.members_directories_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'cabinet_compositions.assembly_tenures_id')
        ->select('cabinet_compositions.*', 'members_directories.name as membername','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('cabinet_compositions.lang', app()->getLocale())
        
        ->get();
        $members = MembersDirectory::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();

        return view('cabinetcomposition', compact('allRows','members','assemblyTenure','singleRow'));
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
            'members_directories_id' => 'required',
            'assembly_tenures_id' => 'required',
            'category' => 'required',
            'tabs' => 'required',
            'cfromdate' => 'required',
            'ctodate' => 'required',
            // 'leaderofthehouse' => 'required',
            // 'leaderofopposition' => 'required',
            'description' => 'required'
        ]);

        $table = CabinetComposition::find($id);  
        $table->members_directories_id = $request->members_directories_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->category = $request->category;
        $table->tabs = $request->tabs;
        $table->cfromdate = $request->cfromdate;
        $table->ctodate = $request->ctodate;
        
        // $table->leaderofthehouse = $request->leaderofthehouse;
        // $table->leaderofopposition = $request->leaderofopposition;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('cabinetcomposition.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = CabinetComposition::find($id);
        $singleRow->delete();
        return redirect()->route('cabinetcomposition.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
