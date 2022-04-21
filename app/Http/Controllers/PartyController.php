<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:party-list|party-create|party-edit|party-delete', ['only' => ['index','store']]);
         $this->middleware('permission:party-create', ['only' => ['create','store']]);
         $this->middleware('permission:party-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:party-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partyList = Party::all()->where('lang', app()->getLocale());
        return view('party', compact('partyList'));
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
            'party_name' => 'required',
            'party_type' => 'required'
        ]);

        $partyData = new Party;
        $partyData->party_name = $request->party_name;
        $partyData->party_type = $request->party_type;
        $partyData->lang = app()->getLocale();
        $partyData->save();
        return redirect()->route('party.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($ignore,$id)
    {
        $assemblyData = Party::find($id);
        $partyList = Party::all()->where('lang', app()->getLocale());
        // dd($s);
        return view('party', compact('assemblyData','partyList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ddddd, Request $request, $id)
    {
        $request->validate([
            'party_name' => 'required',
            'party_type' => 'required'
        ]);

        $assemblyData = Party::find($id);
        $assemblyData->party_name = $request->party_name;
        $assemblyData->party_type = $request->party_type;
        $assemblyData->save();
        return redirect()->route('party.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $assemblyData = Party::find($id);
        $assemblyData->delete();
        return redirect()->route('party.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
