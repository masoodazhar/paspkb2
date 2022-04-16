<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Glossary;
use DB;
class GlossaryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:picture-gallery-list|picture-gallery-create|picture-gallery-edit|picture-gallery-delete', ['only' => ['index','store']]);
         $this->middleware('permission:picture-gallery-create', ['only' => ['create','store']]);
         $this->middleware('permission:picture-gallery-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:picture-gallery-delete', ['only' => ['destroy']]);
    } 
    
    public function get_glossary($locale='en')
    {
        $allRows = DB::table('glossaries')->select('*')->where('lang',$locale)->where('gid',1)->first();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $singleRows = DB::table('glossaries')->select('*')->where('lang',app()->getLocale())->where('gid',1)->first();
        return view('glossary', compact('singleRows'));
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
            'description' => 'required'
        ]);

        $table = new Glossary;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('glossary.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRows = DB::table('glossaries')->select('*')->where('lang',app()->getLocale())->where('gid',1)->first();
        return view('glossary', compact('singleRows'));
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

        $table = Glossary::find($id);
        $table->description = $request->description;
        $table->save();
        return redirect()->route('glossary.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Glossary::find($id);
        $singleRow->delete();
        return redirect()->route('glossary.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
