<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RulesOfProcedures;
use DB;
class RulesOfProceduresController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:working-of-assembly-list|working-of-assembly-edit', ['only' => ['index','store']]);
         $this->middleware('permission:working-of-assembly-edit', ['only' => ['edit','update']]);
    }
    
    public function get_rulesofprocedures($id=false, $locale='en')
    {
        if(is_numeric($id)){

            $rulesOfProcedures = DB::table('rules_of_procedures')->where('lang', $locale)->where('id', $id)->get()->first();
            return response()->json($rulesOfProcedures);

        }else{

            $rulesOfProcedures = DB::table('rules_of_procedures')->where('lang', $locale)->get();
            return response()->json($rulesOfProcedures);
            
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = RulesOfProcedures::all()->where('lang', app()->getLocale());
        return view('rulesofprocedures', compact('allRows'));
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
            'description' => 'required'
        ]);

        $table = new RulesOfProcedures;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('rulesofprocedures.index')->with(['success'=>'Data has been Updated successfully']);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ignore, $id)
    {
        $singleRow = RulesOfProcedures::find($id);
        $allRows = RulesOfProcedures::all()->where('lang', app()->getLocale());
        return view('rulesofprocedures', compact('singleRow','allRows'));
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
            'description' => 'required'
        ]);

        $table = RulesOfProcedures::find($id);
        $table->name = $request->name;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('rulesofprocedures.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = RulesOfProcedures::find($id);
        $singleRow->delete();
        return redirect()->route('rulesofprocedures.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
