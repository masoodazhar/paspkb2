<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publications;
use App\Models\AssemblyTenure;
use DB;

class PublicationsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:publications-list|publications-create|publications-edit|publications-delete', ['only' => ['index','store']]);
         $this->middleware('permission:publications-create', ['only' => ['create','store']]);
         $this->middleware('permission:publications-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:publications-delete', ['only' => ['destroy']]);
    }

    public function get_publications_reports($page, $tenureid, $title=false, $locale='en')
    {


        if($title !='en' || $title !='ur' || $title !='sd'){

            $allRows = DB::table('publications');


            $allRows->join('assembly_tenures','assembly_tenures.id','=','publications.assembly_tenures_id');
            $allRows->select('publications.*','assembly_tenures.fromdate as tfdate','assembly_tenures.todate as ttdate');
            $allRows->where('publications.assembly_tenures_id', $tenureid);
            $allRows->where('page', $page);
            $allRows->where('publications.lang', $locale);
            if(!in_array($title, ['en','ur','sd'])){
                $allRows->where('title','like', '%'.$title.'%');
            }
            $data = $allRows->get();

        }else{
            if($title =='en' || $title =='ur' || $title =='sd'){
                $locale = $title;
            }
            $allRows = DB::table('publications')
            ->join('assembly_tenures','assembly_tenures.id','=','publications.assembly_tenures_id')
            ->select('publications.*','assembly_tenures.fromdate as tfdate','assembly_tenures.todate as ttdate')
            ->where('publications.assembly_tenures_id', $tenureid)
            ->where('page', $page)
            ->where('publications.lang', $locale)
            ->get();
        }
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $allRows = DB::table('publications')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'publications.assembly_tenures_id')
        ->select('publications.*', 'assembly_tenures.fromdate','assembly_tenures.todate')
        ->get();
        // $assemblyTenures = AssemblyTenure::all();
        $assemblyTenures = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        // dd($allRows);
        return view('publications', compact('allRows','assemblyTenures'));
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
            'department_committee' => 'required',
            'title' => 'required',
            'date' => 'required',
            'department_type' => 'required',
            'type' => 'required',
            'page' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = new Publications;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->department_committee = $request->department_committee;
        $table->title = $request->title;
        $table->date = $request->date;
        $table->department_type = $request->department_type;
        $table->page = $request->page;
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
        return redirect()->route('publications.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Publications::find($id);
        // dd($singleRow);
        $allRows = DB::table('publications')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'publications.assembly_tenures_id')
        ->select('publications.*', 'assembly_tenures.fromdate','assembly_tenures.todate')
        ->get();
        // $assemblyTenures = AssemblyTenure::all();
        $assemblyTenures = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        return view('publications', compact('allRows','singleRow','assemblyTenures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assembly_tenures_id' => 'required',
            'department_committee' => 'required',
            'title' => 'required',
            'date' => 'required',
            'department_type' => 'required',
            'type' => 'required',
            'page' => 'required',
            // 'image_pdf_link' => 'required'
        ]);

        $table = Publications::find($id);
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->department_committee = $request->department_committee;
        $table->title = $request->title;
        $table->date = $request->date;
        $table->department_type = $request->department_type;
        $table->type = $request->type;
        $table->page = $request->page;
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
        return redirect()->route('publications.index')->with(['success'=>'Data has been Updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = Publications::find($id);
        $singleRow->delete();
        return redirect()->route('publications.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
