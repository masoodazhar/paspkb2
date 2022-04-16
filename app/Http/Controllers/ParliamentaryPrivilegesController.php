<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParliamentaryPrivileges;
use DB;
class ParliamentaryPrivilegesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:parliamentary-privileges-list|parliamentary-privileges-create|parliamentary-privileges-edit|parliamentary-privileges-delete', ['only' => ['index','store']]);
         $this->middleware('permission:parliamentary-privileges-create', ['only' => ['create','store']]);
         $this->middleware('permission:parliamentary-privileges-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:parliamentary-privileges-delete', ['only' => ['destroy']]);
    }

    // public function get_parliamentaryprivileges($status='parliamentaryprivileges')
    public function get_parliamentaryprivileges($status='parliamentaryprivileges', $locale='en')
    {
        if($status=='parliamentaryprivileges'){
        
            $allRows = DB::table('parliamentary_privileges')->where('lang', $locale)->get();
        
        }else{
        
            $allRows = DB::table('parliamentary_privileges')->select()->where('status','notification')->where('lang', $locale)->get();
        
        }
        return response()->json($allRows);
    }
    public function get_parliamentaryprivilegesByid($id, $locale='en')
    {
        $allRows = DB::table('parliamentary_privileges')->where('lang', $locale)->where('id', $id)->get()->first();        
        return response()->json($allRows);
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = ParliamentaryPrivileges::all()->where('lang', app()->getLocale());
        return view('parliamentaryprivileges', compact('allRows'));
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
            'dateofpassing' => 'required',
            'actno' => 'required',
            'dateofgovernersassent' => 'required',
            'status' => 'required',
            'description' => 'required'
        ]);
           

        $table = new ParliamentaryPrivileges;
        $table->name = $request->name;
        $table->dateofpassing = $request->dateofpassing;
        $table->actno = $request->actno;
        $table->dateofgovernersassent = $request->dateofgovernersassent;
        $table->status = $request->status;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('parliamentaryprivileges.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = ParliamentaryPrivileges::find($id); 
        $allRows = ParliamentaryPrivileges::all()->where('lang', app()->getLocale());
        return view('parliamentaryprivileges', compact('allRows','singleRow'));
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
            'dateofpassing' => 'required',
            'actno' => 'required',
            'dateofgovernersassent' => 'required',
            'status' => 'required',
            'description' => 'required'
        ]);

        $table = ParliamentaryPrivileges::find($id);
        $table->name = $request->name;
        $table->dateofpassing = $request->dateofpassing;
        $table->actno = $request->actno;
        $table->dateofgovernersassent = $request->dateofgovernersassent;
        $table->status = $request->status;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('parliamentaryprivileges.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = ParliamentaryPrivileges::find($id);
        $singleRow->delete();
        return redirect()->route('parliamentaryprivileges.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
