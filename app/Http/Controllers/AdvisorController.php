<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Advisor;
use App\Models\AssemblyTenure;

class AdvisorController extends Controller
{
    public function get_advisor($tenure, $locale='en'){
        $allRows = DB::table('advisors')
        ->where('assembly_tenures_id', $tenure)
        ->where('category', 'Advisor To CM')
        ->where('lang', $locale)
        ->get();

        return response()->json($allRows);
    }
    public function get_specialadvisor($tenure, $locale='en'){
        $allRows = DB::table('advisors')
        ->where('assembly_tenures_id', $tenure)
        ->where('category', 'Special Advisor To CM')
        ->where('lang', $locale)
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
        $allRows = Advisor::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        return view('advisor', compact('allRows','assemblyTenure'));
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
        // $path = $request->file('image')->store('members');
        // Storage::putFile('members', $request->file('image'));
        $request->validate([
             'assembly_tenures_id' => 'required',
             'name' => 'required',
             'fatherhusbandname' => 'required',
             'constituency' => 'required',
             'partyassociation' => 'required',
             'phonenumber' => 'required',
             'birthday' => 'required',
            ]);
        
        // dd($request->all());
        
        $table = new Advisor;

        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->image = $request->image;
        $table->fatherhusbandname = $request->fatherhusbandname;
        $table->birthday = $request->birthday;
        $table->constituency = $request->constituency;
        $table->district = $request->district;
        $table->partyassociation = $request->partyassociation;
        $table->phonenumber = $request->phonenumber;
        $table->email = $request->email;
        $table->presentaddress = $request->presentaddress;
        $table->permanentaddress = $request->permanentaddress;
        $table->category = $request->category;
        $table->lang = app()->getLocale();
       


       if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('uploads'), $imageName);
            $table->image =  $imageName;
       } 

        $table->save();
        return redirect()->route('advisor.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Advisor::find($id); 
        $allRows = Advisor::all()->where('lang', app()->getLocale());
        $assemblyTenure = AssemblyTenure::orderBy('id', 'desc')->where('lang', app()->getLocale())->get();
        return view('advisor', compact('allRows','singleRow','assemblyTenure'));
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
             'fatherhusbandname' => 'required',
             'constituency' => 'required',
             'partyassociation' => 'required',
             'phonenumber' => 'required',
             'birthday' => 'required',
        ]);

        $table = Advisor::find($id);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('uploads'), $imageName);
            $table->image =  $imageName;           
        }else{
            $table->image = $table->image;            
        }

        $table->assembly_tenures_id = $request->assembly_tenures_id;
        $table->name = $request->name;
        $table->fatherhusbandname = $request->fatherhusbandname;
        $table->birthday = $request->birthday;
        $table->constituency = $request->constituency;
        $table->district = $request->district;
        $table->partyassociation = $request->partyassociation;
        $table->phonenumber = $request->phonenumber;
        $table->email = $request->email;
        $table->presentaddress = $request->presentaddress;
        $table->permanentaddress = $request->permanentaddress;
        $table->category = $request->category;

        $table->save();
        return redirect()->route('advisor.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Advisor::find($id);
        $singleRow->delete();
        return redirect()->route('advisor.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
