<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PastAssemblyMembers;
use App\Models\AssemblyTenure;
use DB;


class PastAssemblyMembersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:past-assembly-members-list|past-assembly-members-create|past-assembly-members-edit|past-assembly-members-delete', ['only' => ['index','store']]);
         $this->middleware('permission:past-assembly-members-create', ['only' => ['create','store']]);
         $this->middleware('permission:past-assembly-members-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:past-assembly-members-delete', ['only' => ['destroy']]);
    }

    public function get_pastassemblymembers($id=false, $locale='en')
    {
        if(is_numeric($id)){
            $allRows = DB::table('past_assembly_members')->where('id', $id)->where('lang', $locale)->get()->first();
        }else{
            $allRows = DB::table('past_assembly_members')->where('lang', $locale)->get();
        }
        return response()->json($allRows);
    }
    public function get_pastassemblymembersbyTenure($tenureid, $locale='en')
    {
        $allRows = DB::table('past_assembly_members')
        ->join('assembly_tenures', 'assembly_tenures.id','past_assembly_members.assemblytenures_id')  
        ->select('past_assembly_members.*')
        ->where('past_assembly_members.assemblytenures_id', $tenureid)
        ->where('past_assembly_members.lang', $locale)
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
        $allRows = PastAssemblyMembers::all()->where('lang',app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        return view('pastassemblymembers', compact('allRows','assemblyTenure'));
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
            'type' => 'required',
            'fromdate' => 'required',
            'todate' => 'required',
            'assemblytenures_id'=> 'required',
            'image_pdf_link' => 'required'
        ]);
           

        $table = new PastAssemblyMembers;
        $table->name = $request->name;
        $table->type = $request->type;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->assemblytenures_id = $request->assemblytenures_id;
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
        return redirect()->route('pastassemblymembers.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = PastAssemblyMembers::find($id); 
        $allRows = PastAssemblyMembers::all()->where('lang',app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        return view('pastassemblymembers', compact('allRows','singleRow','assemblyTenure'));
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
            'name' => 'required',
            'type' => 'required',
            'fromdate' => 'required',
            'todate' => 'required',
            'assemblytenures_id'=> 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = PastAssemblyMembers::find($id);
        
        $table->name = $request->name;
        $table->fromdate = $request->fromdate;
        $table->todate = $request->todate;
        $table->assemblytenures_id = $request->assemblytenures_id;
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
        return redirect()->route('pastassemblymembers.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = PastAssemblyMembers::find($id);
        $singleRow->delete();
        return redirect()->route('pastassemblymembers.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
