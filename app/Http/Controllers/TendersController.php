<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenders;
Use DB;

class TendersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tenders-list|tenders-create|tenders-edit|tenders-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tenders-create', ['only' => ['create','store']]);
         $this->middleware('permission:tenders-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tenders-delete', ['only' => ['destroy']]);
    } 
    
    public function get_tenders($page, $locale='en')
    {
        $allRows = DB::table('tenders')
        ->select('*')
        ->where('page', $page)
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
    {   $allRows = Tenders::all()->where('lang',app()->getLocale());
        return view('tenders', compact('allRows'));
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
            'tenderno' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'department' => 'required',
            'type'=>  'required',
            'page'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = new Tenders;
        $table->tenderno = $request->tenderno;
        $table->subject = $request->subject;
        $table->date = $request->date;
        $table->department = $request->department;
        $table->type = $request->type;
        $table->page = $request->page;
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
        return redirect()->route('tenders.index')->with(['success'=>'Data has been Saved successfully']);
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
        
        $singleRow = Tenders::find($id); 
        $allRows = Tenders::all()->where('lang',app()->getLocale());

        return view('tenders', compact('allRows','singleRow'));
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
            'tenderno' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'department' => 'required',
            'type'=>  'required',
            'page'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = Tenders::find($id);
        $table->tenderno = $request->tenderno;
        $table->subject = $request->subject;
        $table->date = $request->date;
        $table->department = $request->department;
        $table->type = $request->type;
        $table->page = $request->page;

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
        return redirect()->route('tenders.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Tenders::find($id);
        $singleRow->delete();
        return redirect()->route('tenders.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
