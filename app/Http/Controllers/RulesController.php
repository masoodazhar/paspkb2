<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rules;
use DB;
class RulesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:rules-list|rules-create|rules-edit|rules-delete', ['only' => ['index','store']]);
         $this->middleware('permission:rules-create', ['only' => ['create','store']]);
         $this->middleware('permission:rules-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:rules-delete', ['only' => ['destroy']]);
    }

    public function get_rules($id=false, $locale='en'){
        if(is_numeric($id)){
            $allRows = DB::table('rules')->where('lang', $locale)->where('id', $id->get())->first();
        }else{
            $allRows = DB::table('rules')->where('lang', $locale)->get();
        }
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = Rules::all()->where('lang', app()->getLocale());
        return view('rules', compact('allRows'));
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
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);
           

        $table = new Rules;
        $table->name = $request->name;
        $table->type = $request->type;
        $table->lang = app()->getLocale();
        if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $table->image_pdf_link =  $imageName;             
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $table->image_pdf_link = $request->image_pdf_link;
        }

        $table->save();
        return redirect()->route('rules.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = Rules::find($id); 
        $allRows = Rules::all()->where('lang', app()->getLocale());
        return view('rules', compact('allRows','singleRow'));
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
            'type' => 'required',
            'image_pdf_link' => 'required'
        ]);

        $table = Rules::find($id);
        $table->name = $request->name;
        $table->type = $request->type;
        if($request->hasFile('image_pdf_link')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->image_pdf_link->extension();       
                $request->image_pdf_link->move(public_path('uploads'), $imageName);
                $table->image_pdf_link =  $imageName;             
            }else{
                $table->image_pdf_link = $request->image_pdf_link;
            }
        }else{
            $table->image_pdf_link = $request->image_pdf_link;
        }

        $table->save();
        return redirect()->route('rules.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Rules::find($id);
        $singleRow->delete();
        return redirect()->route('rules.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
