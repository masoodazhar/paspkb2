<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faqs;
use DB;
class FaqsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:video-archive-list|video-archive-create|video-archive-edit|video-archive-delete', ['only' => ['index','store']]);
         $this->middleware('permission:video-archive-create', ['only' => ['create','store']]);
         $this->middleware('permission:video-archive-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:video-archive-delete', ['only' => ['destroy']]);
    } 

    public function get_faqs($locale='en')
    {
        $allRows = DB::table('faqs')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $allRows = Faqs::all();
        return view('faqs', compact('allRows'));
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
            'description' => 'required',
        ]);

        $table = new Faqs;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('faqs.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = Faqs::find($id); 
        $allRows = Faqs::all();

        return view('faqs', compact('allRows','singleRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $table = Faqs::find($id);
        $table->name = $request->name;
        $table->description = $request->description;
        $table->save();
        return redirect()->route('faqs.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleRow = Faqs::find($id);
        $singleRow->delete();
        return redirect()->route('faqs.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
