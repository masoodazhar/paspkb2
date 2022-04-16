<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StagesOfBills;
use DB; 

class StagesOfBillsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:stages-of-bills-list|stages-of-bills-create|stages-of-bills-edit|stages-of-bills-delete', ['only' => ['index','store']]);
         $this->middleware('permission:stages-of-bills-create', ['only' => ['create','store']]);
         $this->middleware('permission:stages-of-bills-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:stages-of-bills-delete', ['only' => ['destroy']]);
    }  

    public function get_stagesofbills($locale='en')
    {
        // $allRows = StagesOfBills::all(1);
        $allRows =  DB::table('stages_of_bills')->select('*')->where('lang', $locale)->where('stagesid',1)->first();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $singleRow = StagesOfBills::find(1); 
        $singleRows = DB::table('stages_of_bills')->select('*')->where('lang',app()->getLocale())->where('stagesid',1)->first();
        return view('stagesofbills', compact('singleRows'));
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
       
        // $singleRow = StagesOfBills::find($id);
        $singleRows = DB::table('stages_of_bills')->select('*')->where('lang',app()->getLocale())->where('stagesid',1)->first(); 
        return view('stagesofbills', compact('singleRows'));
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
            'description' => 'required'
        ]);

        $table = StagesOfBills::find($id);
        $table->description = $request->description;
        $table->save();
        return redirect()->route('stagesofbills.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = StagesOfBills::find($id);
        $singleRow->delete();
        return redirect()->route('stagesofbills.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
