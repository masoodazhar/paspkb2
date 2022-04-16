<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Contactus;
class ContactusController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:contactus-list|contactus-edit', ['only' => ['index','store']]);
    //      $this->middleware('permission:contactus-edit', ['only' => ['edit','update']]);
     
    // }

    function get_contactus(){

        $allRows = Contactus::find(1);
        return json_encode($allRows);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singleRow = Contactus::find(1);
        // dd($singleRow);
        return view('contactus', compact('singleRow'));
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
            'address' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'mailfrom' => 'required',
            'mailto' => 'required'
        ]);
           

        $table = new Contactus;
        $table->address = $request->address;
        $table->phone = $request->phone;
        $table->fax = $request->fax;
        $table->mailfrom = $request->mailfrom;
        $table->mailto = $request->mailto;
        $table->save();
        return redirect()->route('contactus.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($id)
    {
       
        $singleRow = About::find($id); 
        $allRows = About::all();
        return view('about', compact('allRows','singleRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'mailfrom' => 'required',
            'mailto' => 'required'
        ]);

        $table = Contactus::find(1);
        $table->address = $request->address;
        $table->phone = $request->phone;
        $table->fax = $request->fax;
        $table->mailfrom = $request->mailfrom;
        $table->mailto = $request->mailto;
        $table->save();
        return redirect()->route('contactus')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
