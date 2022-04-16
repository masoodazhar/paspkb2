<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactList;
use DB;

class ContactListController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:contact-list-list|contact-list-create|contact-list-edit|contact-list-delete', ['only' => ['index','store']]);
         $this->middleware('permission:contact-list-create', ['only' => ['create','store']]);
         $this->middleware('permission:contact-list-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:contact-list-delete', ['only' => ['destroy']]);
    }

    public function get_contactlist($locale='en'){
        $allRows = DB::table('contact_lists')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = ContactList::all()->where('lang', app()->getLocale());
        return view('contactlist', compact('allRows'));
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
            'office' => 'required',
            'residence' => 'required',
            'description' => 'required'
        ]);
           

        $table = new ContactList;
        $table->name = $request->name;
        $table->designation = $request->designation;
        $table->office = $request->office;
        $table->residence = $request->residence;
        $table->description = $request->description;
        $table->lang = app()->getLocale();

        $table->save();
        return redirect()->route('contactlist.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = ContactList::find($id); 
        $allRows = ContactList::all()->where('lang', app()->getLocale());
        return view('contactlist', compact('allRows','singleRow'));
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
            'office' => 'required',
            'residence' => 'required',
            'description' => 'required'
        ]);

        $table = ContactList::find($id);
        $table->name = $request->name;
        $table->designation = $request->designation;
        $table->office = $request->office;
        $table->residence = $request->residence;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('contactlist.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = ContactList::find($id);
        $singleRow->delete();
        return redirect()->route('contactlist.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
