<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportsLaid;
use App\Models\AssemblyTenure;
use DB;

class ReportsLaidController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:press-releases-list|press-releases-create|press-releases-edit|press-releases-delete', ['only' => ['index','store']]);
         $this->middleware('permission:press-releases-create', ['only' => ['create','store']]);
         $this->middleware('permission:press-releases-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:press-releases-delete', ['only' => ['destroy']]);
    } 

    public function get_reportslaid($tenureid, $locale='en')
    {
      
            $allRows = DB::table('reports_laids')  
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'reports_laids.assembly_tenures_id')
            ->select('reports_laids.*','assembly_tenures.fromdate as tenurefromdate','assembly_tenures.todate as tenuretodate')
            ->where('reports_laids.assembly_tenures_id',$tenureid)
            ->where('reports_laids.lang',$locale)
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
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $allRows = DB::table('reports_laids')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'reports_laids.assembly_tenures_id')
        ->select('reports_laids.*', 'assembly_tenures.fromdate', 'assembly_tenures.todate')
        ->where('reports_laids.lang',app()->getLocale())
        ->get();
        return view('reportslaid', compact('allRows','assemblyTenure'));
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
            'assembly_tenures_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'committee'=>  'required',
            'image_pdf_link' => 'required',
        ]);
           

        $table = new ReportsLaid;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->type = $request->type;
        $table->date = $request->date;
        $table->committee = $request->committee;
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
        return redirect()->route('reportslaid.index')->with(['success'=>'Data has been Saved successfully']);
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
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $singleRow = ReportsLaid::find($id); 
        // dd($singleRow);
        $allRows =  DB::table('reports_laids')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'reports_laids.assembly_tenures_id')
        ->select('assembly_tenures.*', 'reports_laids.*')
        ->where('reports_laids.lang',app()->getLocale())
        ->get();
        return view('reportslaid', compact('allRows','singleRow','assemblyTenure'));
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
            'assembly_tenures_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'committee'=>  'required',
            'image_pdf_link' => 'required'
        ]);

        $table = ReportsLaid::find($id);
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->type = $request->type;
        $table->date = $request->date;
        $table->committee = $request->committee;
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
        return redirect()->route('reportslaid.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = ReportsLaid::find($id);
        $singleRow->delete();
        return redirect()->route('reportslaid.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
