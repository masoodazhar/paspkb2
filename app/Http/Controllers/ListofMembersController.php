<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListofMembers;

class ListofMembersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:list-of-members-list|list-of-members-create|list-of-members-edit|list-of-members-delete', ['only' => ['index','store']]);
         $this->middleware('permission:list-of-members-create', ['only' => ['create','store']]);
         $this->middleware('permission:list-of-members-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:list-of-members-delete', ['only' => ['destroy']]);
    }

    public function get_listofmembers($id=false, $locale='en')
    {
        if(is_numeric($id)){

            $allRows = ListofMembers::all()->where('id', $id)->where('lang', $locale)->first();
        }else{

            $allRows = ListofMembers::where('lang', $locale)->get();
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
        $allRows = ListofMembers::all()->where('lang',app()->getLocale());
        return view('listofmembers', compact('allRows'));
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


        $table = new ListofMembers;
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
        return redirect()->route('listofmembers.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = ListofMembers::find($id);
        $allRows = ListofMembers::all()->where('lang',app()->getLocale());
        return view('listofmembers', compact('allRows','singleRow'));
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

        $table = ListofMembers::find($id);
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
        return redirect()->route('listofmembers.index')->with(['success'=>'Data has been Updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = ListofMembers::find($id);
        $singleRow->delete();
        return redirect()->route('listofmembers.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
