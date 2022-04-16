<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\StandingCommittees;
use App\Models\StandingCommitteesCategory;


class StandingCommitteesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:standing-committees-list|standing-committees-create|standing-committees-edit|standing-committees-delete', ['only' => ['index','store']]);
         $this->middleware('permission:standing-committees-create', ['only' => ['create','store']]);
         $this->middleware('permission:standing-committees-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:standing-committees-delete', ['only' => ['destroy']]);
    } 

    public function get_standingcommitteescategories($locale='en')
    {
        $allRows = DB::table('standing_committees_categories')->where('lang', $locale)->get();
        return response()->json($allRows);
    }

    public function get_standingcommitteescategory_by_id($id, $locale='en')
    {
        $allRows = DB::table('standing_committees_categories')->where('id', $id)->where('lang', $locale)->first();
        return response()->json($allRows);
    }

    public function get_standingcommittees($category, $locale='en')
    {
        $allRows = DB::table('standing_committees')
        ->join('standing_committees_categories','standing_committees_categories.id','=','standing_committees.standing_committees_categories_id')
        ->select('standing_committees.*','standing_committees_categories.category')
        ->where('standing_committees.standing_committees_categories_id', $category)
        ->where('standing_committees.lang', $locale)
        ->get();
        return response()->json($allRows);
    }
    
    public function get_standingcommitteesmembers($category, $locale='en'){
        $singleRow = DB::table('standingcommitteesmember')
        ->select('*')
        ->where('standingcommitteesmember.acc_id', $category)
        ->where('standingcommitteesmember.lang', $locale)
        ->first();

        $ids = [];
        
        if($singleRow){
            $ids = json_decode($singleRow->members_directories_id);
        }

        $members = DB::table('members_directories')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'members_directories.assembly_tenures_id')
        ->select('members_directories.*','assembly_tenures.*')
        ->whereIn('members_directories.id',$ids)
        ->where('members_directories.lang', $locale)
        ->get();
        // dd($members);
        return response()->json($members);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = StandingCommittees::all()->where('lang',app()->getLocale());
        $headings = StandingCommitteesCategory::all()->where('lang',app()->getLocale());
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        return view('standingcommittees', compact('allRows','memberDirectories','headings'));
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
        $table = new StandingCommittees;
        $request->validate([
            'standing_committees_categories_id' => 'required',
            'tab_type' => 'required',
            'title' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);
        
        $table->standing_committees_categories_id = $request->standing_committees_categories_id;
        $table->tab_type = $request->tab_type;
        $table->title = $request->title;
        $table->type = $request->type;
        $table->lang = app()->getLocale();

        if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $table->image_pdf_link =  $imageName;             
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $table->image_pdf_link = $request->image_pdf_link;
        }
        $table->save();
        return redirect()->route('standingcommittees.index')->with(['success'=>'Data has been Saved successfully']);
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
        $allRows = StandingCommittees::all()->where('lang',app()->getLocale());
        $headings = StandingCommitteesCategory::all()->where('lang',app()->getLocale());
        $memberDirectories = DB::table('members_directories')->where('lang',app()->getLocale())->get();
        $singleRow = StandingCommittees::find($id); 
        return view('standingcommittees', compact('allRows','singleRow','memberDirectories','headings'));
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
        if($request->check=='true'){            
            $request->validate([
                'acc_id' => 'required',
                'members_directories_id' => 'required'
            ]);
            $beforeData = DB::table('standingcommitteesmember')
            ->select('standingcommitteesmember.acc_id')
            ->where('standingcommitteesmember.acc_id', $request->acc_id)
            ->first();
            if($beforeData){
                DB::update('update standingcommitteesmember set 
                acc_id=?,
                members_directories_id=?
                where acc_id = ?',
                [$request->acc_id, json_encode($request->members_directories_id),$request->acc_id]);
            }else{
                DB::update('insert into standingcommitteesmember (acc_id,members_directories_id) values(?,?)',
                [$request->acc_id, json_encode($request->members_directories_id)]);
            }
           
             
        }else{  

          
            $request->validate([
                'standing_committees_categories_id' => 'required',
                'tab_type' => 'required',
                'title' => 'required',
                'type' => 'required',
                'image_pdf_link' => 'required'
            ]);
            
            $table = StandingCommittees::find($id);
            $table->standing_committees_categories_id = $request->standing_committees_categories_id;
            $table->tab_type = $request->tab_type;
            $table->title = $request->title;
            $table->type = $request->type;
            if($request->hasFile('image_pdf_link')){
                if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                    $imageName = time().'.'.$request->image_pdf_link->extension();       
                    $request->image_pdf_link->move(public_path('uploads'), $imageName);
                    $table->image_pdf_link =  $imageName;             
                }else{
                    $table->image_pdf_link = $request->image_pdf_link;
                }
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
            $table->save();
        }
        return redirect()->route('standingcommittees.index')->with(['success'=>'Data has been Updated successfully']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = StandingCommittees::find($id);
        $singleRow->delete();
        return redirect()->route('standingcommittees.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
