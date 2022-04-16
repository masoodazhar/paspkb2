<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommitteeonGovernmentAssurance;
use App\Models\Assembly;
use DB;

class CommitteeonGovernmentAssuranceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:committee-on-government-assurance-list|committee-on-government-assurance-create|committee-on-government-assurance-edit|committee-on-government-assurance-delete', ['only' => ['index','store']]);
         $this->middleware('permission:committee-on-government-assurance-create', ['only' => ['create','store']]);
         $this->middleware('permission:committee-on-government-assurance-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:committee-on-government-assurance-delete', ['only' => ['destroy']]);
    } 

    public function get_committee_government_assurance($locale='en'){
        $allRows = DB::table('committeeon_government_assurances')
        ->join('assemblies', 'assemblies.id', '=', 'committeeon_government_assurances.assembly_id')
        ->join('members_directories', 'members_directories.id', '=', 'committeeon_government_assurances.members_directories_id')
        ->where('committeeon_government_assurances.lang', $locale)
        
        ->select('committeeon_government_assurances.*', 'assemblies.name as assemblyname','assemblies.id as assemblyid','members_directories.name as membername')
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_speakersmain($locale='en')
    {
        $singleRow = DB::table('speakers_main')
        ->join('members_directories', 'members_directories.id','speakers_main.members_directories_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('speakers_main.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('speakers_main.lang', $locale)
        ->get()
        ->first();
        return response()->json($singleRow);
    }

    public function get_deputyspeakermain($locale='en')
    {
        $singleRow = DB::table('deputy_speakers_main')
        ->join('members_directories', 'members_directories.id','deputy_speakers_main.members_directories_id')  
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('deputy_speakers_main.*','members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate')
        ->where('deputy_speakers_main.lang', $locale)
        ->get()
        ->first();
        return response()->json($singleRow);
    }

    public function get_committee_government_assurance_members($assembly, $locale='en'){

        $singleRow = DB::table('committeeon_government_assurances')
        ->join('assemblies', 'assemblies.id', '=', 'committeeon_government_assurances.assembly_id')
        ->join('members_directories', 'members_directories.id', '=', 'committeeon_government_assurances.members_directories_id')
        ->select('committeeon_government_assurances.*','members_directories.name as membername','members_directories.email', 'members_directories.permanentaddress','members_directories.phonenumber as membercotact','assemblies.name as assemblyname','assemblies.id as assemblyid')
        ->where('committeeon_government_assurances.assembly_id',$assembly)
        ->where('committeeon_government_assurances.lang',$locale)        
        ->first();
        $memberData = array();
        if($singleRow){
            $ids = json_decode($singleRow->members_directories_ids);
           
            $members = DB::table('members_directories')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
            ->select('members_directories.*','assembly_tenures.*')
            ->whereIn('members_directories.id',$ids)
            ->where('members_directories.lang',$locale)
            ->get();
            array_push($memberData, array('member'=> $singleRow, 'othermeneres'=>$members));
        }
        
        // dd($memberData);
        return response()->json($memberData);
    }

    public function get_committee_government_assurance_byassembly($assembly, $locale='en'){
        
        $allRows = DB::table('current_assembly_summaries')  
        ->join('assemblies', 'assemblies.id', '=', 'current_assembly_summaries.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'current_assembly_summaries.assembly_tenures_id')
        ->join('parliamentary_years', 'parliamentary_years.id', '=', 'current_assembly_summaries.parliamentary_years_id')
        ->join('sessions', 'sessions.id', '=', 'current_assembly_summaries.main_sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->select('current_assembly_summaries.*','assemblies.name as assemblyname','parliamentary_years.name as parliamentaryyearsname','assembly_tenures.fromdate as tenurefromdate','assembly_tenures.todate as tenuretodate','main_sessions.sessionname', 'sessions.id as mainsessionid')
        ->where('current_assembly_summaries.assembly_id',$assembly)
        ->where('current_assembly_summaries.lang',$locale)
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
        $allRows = DB::table('committeeon_government_assurances')
        ->join('assemblies', 'assemblies.id', '=', 'committeeon_government_assurances.assembly_id')
        ->join('members_directories', 'members_directories.id', '=', 'committeeon_government_assurances.members_directories_id')
        ->select('committeeon_government_assurances.*', 'assemblies.name as assemblyname','members_directories.name as membername')
        ->where('committeeon_government_assurances.lang',app()->getLocale())
        ->get();
        $assembly = Assembly::all()->where('lang',app()->getLocale());
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        // $assemblytenure = CommitteeonGovernmentAssurance::all()->where('lang',app()->getLocale());
        return view('committeeongovernmentassurance', compact('allRows','assembly','memberDirectories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'assembly_id' => 'required',
            'members_directories_ids' => 'required',
            'committeformationdate' => 'required',
            'committeedissolutiondate' => 'required',
            'Purpose' => 'required',
            'name' => 'required'
        ]);

        $table = new CommitteeonGovernmentAssurance;
        $table->members_directories_id = $request->members_directories_id;
        $table->assembly_id = $request->assembly_id;
        $table->members_directories_ids = json_encode($request->members_directories_ids);
        $table->committeformationdate = $request->committeformationdate;
        $table->committeedissolutiondate = $request->committeedissolutiondate;
        $table->Purpose = $request->Purpose;
        $table->name = $request->name;
        $table->lang = app()->getLocale();

        $table->save();
        return redirect()->route('committeeongovernmentassurance.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = CommitteeonGovernmentAssurance::find($id);
        $assembly = Assembly::all()->where('lang',app()->getLocale());
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        $allRows = DB::table('committeeon_government_assurances')
        ->join('assemblies', 'assemblies.id', '=', 'committeeon_government_assurances.assembly_id')
        ->join('members_directories', 'members_directories.id', '=', 'committeeon_government_assurances.members_directories_id')
        ->select('committeeon_government_assurances.*', 'assemblies.name as assemblyname','members_directories.name as membername')
        ->where('committeeon_government_assurances.lang',app()->getLocale())
        ->get();
        return view('committeeongovernmentassurance', compact('allRows','singleRow','assembly','memberDirectories'));
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
            'assembly_id' => 'required',
            'members_directories_ids' => 'required',
            'committeformationdate' => 'required',
            'committeedissolutiondate' => 'required',
            'Purpose' => 'required',
            'name' => 'required'
        ]);

        $assemblytenureData = CommitteeonGovernmentAssurance::find($id);
        $assemblytenureData->members_directories_id = $request->members_directories_id;
        $assemblytenureData->assembly_id = $request->assembly_id;
        $assemblytenureData->members_directories_ids = json_encode($request->members_directories_ids);
        $assemblytenureData->committeformationdate = $request->committeformationdate;
        $assemblytenureData->committeedissolutiondate = $request->committeedissolutiondate;
        $assemblytenureData->Purpose = $request->Purpose;
        $assemblytenureData->name = $request->name;
        $assemblytenureData->save();
        return redirect()->route('committeeongovernmentassurance.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $assemblytenureData = CommitteeonGovernmentAssurance::find($id);
        $assemblytenureData->delete();
        return redirect()->route('committeeongovernmentassurance.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
