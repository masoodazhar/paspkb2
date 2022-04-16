<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DirectoryOfOfficers;
use DB;

class DirectoryOfOfficersController extends Controller
{
    public function get_directoryofofficers($locale='en')
    {
        $allRows = DB::table('directory_of_officers')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = DirectoryOfOfficers::all()->where('lang', app()->getLocale());
        return view('directoryofofficers', compact('allRows'));
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
            'designation' => 'required',
            'remarks' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
           

        $table = new DirectoryOfOfficers;
        $table->name = $request->name;
        $table->designation = $request->designation;
        $table->bps = $request->bps;
        $table->remarks = $request->remarks;
        $table->phone = $request->phone;
        $table->fax = $request->fax;
        $table->email = $request->email;
        $table->lang = app()->getLocale();
        $table->save();
        return redirect()->route('directoryofofficers.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = DirectoryOfOfficers::find($id); 
        $allRows = DirectoryOfOfficers::all()->where('lang', app()->getLocale());
        return view('directoryofofficers', compact('allRows','singleRow'));
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
            'designation' => 'required',
            'remarks' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $table = DirectoryOfOfficers::find($id);
        $table->name = $request->name;
        $table->designation = $request->designation;
        $table->bps = $request->bps;
        $table->remarks = $request->remarks;
        $table->phone = $request->phone;
        $table->fax = $request->fax;
        $table->email = $request->email;
        $table->save();
        return redirect()->route('directoryofofficers.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = DirectoryOfOfficers::find($id);
        $singleRow->delete();
        return redirect()->route('directoryofofficers.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
