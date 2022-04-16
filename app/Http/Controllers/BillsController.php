<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Bills;
use App\Models\Assembly;
use App\Models\AssemblyTenure;
use App\Models\MembersDirectory;

class BillsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bills-list|bills-create|bills-edit|bills-delete', ['only' => ['index','store']]);
         $this->middleware('permission:bills-create', ['only' => ['create','store']]);
         $this->middleware('permission:bills-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bills-delete', ['only' => ['destroy']]);
    }  

    public function get_bills($tenureid, $locale='en')
    {
            $allRows = DB::table('bills')
            ->join('assemblies', 'assemblies.id', '=', 'bills.assembly_id')
            ->join('assembly_tenures', 'assembly_tenures.id', '=', 'bills.assembly_tenures_id')
            ->join('members_directories', 'members_directories.id', '=', 'bills.members_directories_id')
            ->select('bills.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate','members_directories.name as membername')
            ->where('bills.assembly_tenures_id', $tenureid)
            ->where('bills.lang', $locale)
            ->get();
        
        return response()->json($allRows);
    }

    public function get_billsdetail($id){
        $allRows = DB::table('bills')
        ->join('assemblies', 'assemblies.id', '=', 'bills.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'bills.assembly_tenures_id')
        ->join('members_directories', 'members_directories.id', '=', 'bills.members_directories_id')
        ->select('bills.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate','members_directories.name as membername')
        ->where('bills.id', $id)
        ->first();
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
        $allRows = DB::table('bills')
        ->join('assemblies', 'assemblies.id', '=', 'bills.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'bills.assembly_tenures_id')
        ->join('members_directories', 'members_directories.id', '=', 'bills.members_directories_id')
        ->select('bills.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate','members_directories.name')
        ->where('bills.lang',app()->getLocale())
        ->get();

        $assembly = Assembly::all()->where('lang',app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        // return $parliamentaryyears
        return view('bills', compact('allRows','assembly','assemblyTenure','membersDirectories'));
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
            'assembly_id' => 'required',
            'assembly_tenures_id' => 'required',
            'members_directories_id' => 'required',
            'bill_type' => 'required',
            'title' => 'required',
            'type_tabs' => 'required',
            'type' => 'required',
            'date' => 'required',
            'status' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $parliamentaryyearsData = new Bills;
        $parliamentaryyearsData->assembly_id = $request->assembly_id;
        $parliamentaryyearsData->assembly_tenures_id = $request->assembly_tenures_id;
        $parliamentaryyearsData->members_directories_id = $request->members_directories_id;
        $parliamentaryyearsData->bill_type = $request->bill_type;
        $parliamentaryyearsData->title = $request->title;
        $parliamentaryyearsData->type_tabs = $request->type_tabs;
        $parliamentaryyearsData->type = $request->type;
        $parliamentaryyearsData->date = $request->date;
        $parliamentaryyearsData->status = $request->status;
        $parliamentaryyearsData->lang = app()->getLocale();

        if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $parliamentaryyearsData->image_pdf_link =  $imageName;             
            }else{
                $parliamentaryyearsData->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $parliamentaryyearsData->image_pdf_link = $request->image_pdf_link;
        }
        $parliamentaryyearsData->save();
        return redirect()->route('bills.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Bills::find($id);
        $assembly = Assembly::all()->where('lang',app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang',app()->getLocale())->get();
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());

        $allRows = DB::table('bills')
        ->join('assemblies', 'assemblies.id', '=', 'bills.assembly_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'bills.assembly_tenures_id')
        ->join('members_directories', 'members_directories.id', '=', 'bills.members_directories_id')
        ->select('bills.*', 'assemblies.name as assemblyname','assembly_tenures.fromdate','assembly_tenures.todate','members_directories.name')
        ->where('bills.lang',app()->getLocale())
        ->get();
        
        return view('bills', compact('allRows','singleRow','assembly','assemblyTenure','membersDirectories'));
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
            'assembly_id' => 'required',
            'assembly_tenures_id' => 'required',
            'members_directories_id' => 'required',
            'bill_type' => 'required',
            'title' => 'required',
            'type_tabs' => 'required',
            'type' => 'required',
            'date' => 'required',
            'status' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table =  Bills::find($id);
        $table->assembly_id = $request->assembly_id;
        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->members_directories_id = $request->members_directories_id;
        $table->bill_type = $request->bill_type;
        $table->title = $request->title;
        $table->type_tabs = $request->type_tabs;
        $table->type = $request->type;
        $table->date = $request->date;
        $table->status = $request->status;
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
        return redirect()->route('bills.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $parliamentaryyearsData = Bills::find($id);
        $parliamentaryyearsData->delete();
        return redirect()->route('bills.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
