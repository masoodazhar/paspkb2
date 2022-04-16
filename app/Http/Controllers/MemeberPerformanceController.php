<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\MemeberPerformance;

class MemeberPerformanceController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:members-directory-list|members-directory-create|members-directory-edit|members-directory-delete', ['only' => ['index','store']]);
         $this->middleware('permission:members-directory-create', ['only' => ['create','store']]);
         $this->middleware('permission:members-directory-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:members-directory-delete', ['only' => ['destroy']]);
    }

    public function get_memberprofile($member, $locale='en'){

        $byname = DB::table('elections')
        ->where('elections.members_directories_name_id', $member)
        ->where('elections.lang', $locale)
        ->get()->count();

        

        $current = DB::table('elections')
        ->where('elections.members_directories_current_id', $member)
        ->where('elections.lang', $locale)
        ->get()->count();

        if($byname){
            // return  'asdasdasd';
            $allRows = DB::table('members_directories')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
            ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
            ->join('elections', 'elections.members_directories_name_id', '=', 'members_directories.id')
            ->select('members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate','assemblies.name as assemblyname')
            ->where('members_directories.id', $member)
            ->where('members_directories.lang', $locale)
            ->first();
        }
        elseif($current){
            
            $allRows = DB::table('members_directories')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
            ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
            ->join('elections', 'elections.members_directories_current_id', '=', 'members_directories.id')
            ->select('members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate','assemblies.name as assemblyname')
            ->where('members_directories.id', $member)
            ->where('members_directories.lang', $locale)
            ->first();
        }
        else{
            $allRows = DB::table('members_directories')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
            ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
            ->select('members_directories.*','assembly_tenures.fromdate','assembly_tenures.todate','assemblies.name as assemblyname')
            ->where('members_directories.id', $member)
            ->where('members_directories.lang', $locale)
            ->first();
        }
        
        

        // dd($allRows);
        // $data = array();

        // array_push($data, json_decode($allRows->qualification));

        // print_r($data);

        return response()->json($allRows);
    }

    public function get_membersperformancereport($member, $locale='en'){
        $allRows = DB::table('memeber_performances')
        ->join('members_directories', 'members_directories.id', '=', 'memeber_performances.members_directories_id')
        ->select('memeber_performances.*','members_directories.name as membername', 'members_directories.image')
        ->where('memeber_performances.members_directories_id', $member)
        ->where('memeber_performances.lang', $locale)
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
        $allRows = DB::table('memeber_performances')
        ->join('members_directories', 'members_directories.id', '=', 'memeber_performances.members_directories_id')
        ->select('memeber_performances.*','members_directories.name as membername')
        ->where('memeber_performances.lang',app()->getLocale())
        ->get();
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        // $assemblytenure = CommitteeonGovernmentAssurance::all();
        return view('membersperformancereport', compact('allRows','memberDirectories'));
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
            'assemblyquestiontext' => 'required',
            'assemblyquestionvalue' => 'required',
            'privilegemotionstext' => 'required',
            'privilegemotionsvalue' => 'required',
            'adjournmentmotiontext' => 'required',
            'adjournmentmotionvalue' => 'required',
            'privatebillstext' => 'required',
            'privatebillsvalue' => 'required',
            'Resolutionstext' => 'required',
            'Resolutionsvalue' => 'required',
            'motionstext' => 'required',
            'motionsvalue' => 'required',
        ]);
        $assemblytenureData = new MemeberPerformance;
        $index=0;
        foreach($request->assemblyquestiontext as $a){
            
            $answers[] = [
                'members_directories_id' => $request->members_directories_id,
                'assemblyquestiontext' => $request->assemblyquestiontext[$index],
                'assemblyquestionvalue' => $request->assemblyquestionvalue[$index],

                'privilegemotionstext' => $request->privilegemotionstext[$index],
                'privilegemotionsvalue' => $request->privilegemotionsvalue[$index],

                'adjournmentmotiontext' => $request->adjournmentmotiontext[$index],
                'adjournmentmotionvalue' => $request->adjournmentmotionvalue[$index],
                
                'privatebillstext' => $request->privatebillstext[$index],
                'privatebillsvalue' => $request->privatebillsvalue[$index],

                'Resolutionstext' => $request->Resolutionstext[$index],
                'Resolutionsvalue' => $request->Resolutionsvalue[$index],

                'motionstext' => $request->motionstext[$index],
                'motionsvalue' => $request->motionsvalue[$index],
                'lang'=> app()->getLocale()
            ];

            $index++;
        }
        
        MemeberPerformance::insert($answers);
        // $assemblytenureData->members_directories_id = $request->members_directories_id;
        // $assemblytenureData->assemblyquestiontext = $request->assemblyquestiontext;
        // $assemblytenureData->assemblyquestionvalue = $request->assemblyquestionvalue;
        // $assemblytenureData->privilegemotionstext = $request->privilegemotionstext;
        // $assemblytenureData->privilegemotionsvalue = $request->privilegemotionsvalue;
        // $assemblytenureData->adjournmentmotiontext = $request->adjournmentmotiontext;
        // $assemblytenureData->adjournmentmotionvalue = $request->adjournmentmotionvalue;
        // $assemblytenureData->privatebillstext = $request->privatebillstext;
        // $assemblytenureData->privatebillsvalue = $request->privatebillsvalue;
        // $assemblytenureData->Resolutionstext = $request->Resolutionstext;
        // $assemblytenureData->Resolutionsvalue = $request->Resolutionsvalue;
        // $assemblytenureData->motionstext = $request->motionstext;
        // $assemblytenureData->motionsvalue = $request->motionsvalue;
        // $assemblytenureData->save();
        
        return redirect()->route('membersperformancereport.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($ignore,$id)
    {
        $singleRow = MemeberPerformance::find($id);
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        $allRows = DB::table('memeber_performances')
        ->join('members_directories', 'members_directories.id', '=', 'memeber_performances.members_directories_id')
        ->select('memeber_performances.*','members_directories.name as membername')
        ->where('memeber_performances.lang',app()->getLocale())
        ->get();
        return view('membersperformancereport', compact('allRows','singleRow','memberDirectories'));
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
            'members_directories_id' => 'required',
            'assemblyquestiontext' => 'required',
            'assemblyquestionvalue' => 'required',
            'privilegemotionstext' => 'required',
            'privilegemotionsvalue' => 'required',
            'adjournmentmotiontext' => 'required',
            'adjournmentmotionvalue' => 'required',

            'privatebillstext' => 'required',
            'privatebillsvalue' => 'required',
            'Resolutionstext' => 'required',
            'Resolutionsvalue' => 'required',
            'motionstext' => 'required',
            'motionsvalue' => 'required',

        ]);

        $assemblytenureData = MemeberPerformance::find($id);
        $assemblytenureData->members_directories_id = $request->members_directories_id;
        $assemblytenureData->assemblyquestiontext = $request->assemblyquestiontext[0];
        $assemblytenureData->assemblyquestionvalue = $request->assemblyquestionvalue[0];
        $assemblytenureData->privilegemotionstext = $request->privilegemotionstext[0];
        $assemblytenureData->privilegemotionsvalue = $request->privilegemotionsvalue[0];
        $assemblytenureData->adjournmentmotiontext = $request->adjournmentmotiontext[0];
        $assemblytenureData->adjournmentmotionvalue = $request->adjournmentmotionvalue[0];
        $assemblytenureData->privatebillstext = $request->privatebillstext[0];
        $assemblytenureData->privatebillsvalue = $request->privatebillsvalue[0];
        $assemblytenureData->Resolutionstext = $request->Resolutionstext[0];
        $assemblytenureData->Resolutionsvalue = $request->Resolutionsvalue[0];
        $assemblytenureData->motionstext = $request->motionstext[0];
        $assemblytenureData->motionsvalue = $request->motionsvalue[0];
        $assemblytenureData->save();
        return redirect()->route('membersperformancereport.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $assemblytenureData = MemeberPerformance::find($id);
        $assemblytenureData->delete();
        return redirect()->route('membersperformancereport.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
