<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PowersFunctions;
use DB;

class PowersFunctionsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:powers-and-functions-list|powers-and-functions-create|powers-and-functions-edit|powers-and-functions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:powers-and-functions-create', ['only' => ['create','store']]);
         $this->middleware('permission:powers-and-functions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:powers-and-functions-delete', ['only' => ['destroy']]);
    }

    public function get_powersfunctionsheading($locale='en')
    {
        $singleRow = DB::table('powers_functions_main')->select('*')->where('id',1)->where('lang', $locale)->first();
        return response()->json($singleRow);
    }
    public function get_powersfunctionsall($locale='en'){

        $allRows = DB::table('powers_functions')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = PowersFunctions::all()->where('lang', app()->getLocale());
        $singleRowMain = DB::table('powers_functions_main')
        ->where('powers_functions_main.lang', app()->getLocale())
        ->where('powerid',1)
        ->first();
        return view('powersfunctions', compact('allRows','singleRowMain'));
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


        $table = new PowersFunctions;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('powersfunctions.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRowMain = DB::table('powers_functions_main')
        ->where('powers_functions_main.lang', app()->getLocale())
        ->where('powerid',1)
        ->first();

        $singleRow = PowersFunctions::find($id);
        $allRows = PowersFunctions::all()->where('lang', app()->getLocale());
        return view('powersfunctions', compact('allRows','singleRow','singleRowMain'));
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
                'main_description' => 'required'
            ]);

            DB::update('update powers_functions_main set main_description = ? where id = ?',[$request->main_description,$id]);
        }else{
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $table = PowersFunctions::find($id);
            $table->name = $request->name;
            $table->description = $request->description;
            $table->save();
        }
    return redirect()->route('powersfunctions.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = PowersFunctions::find($id);
        $singleRow->delete();
        return redirect()->route('powersfunctions.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
