<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssemblyLibrary;
use DB;
class AssemblyLibraryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:speakers-list|speakers-create|speakers-edit|speakers-delete', ['only' => ['index','store']]);
         $this->middleware('permission:speakers-create', ['only' => ['create','store']]);
         $this->middleware('permission:speakers-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:speakers-delete', ['only' => ['destroy']]);
    }

    public function get_assemblylibrary($locale='en')
    {
        $allRows = DB::table('assembly_libraries')->where('lang', $locale)->get();
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = AssemblyLibrary::all()->where('lang', app()->getLocale());
        return view('assemblylibrary', compact('allRows'));
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
            'link' => 'required',
            'logo' => 'required'
        ]);
           

        $table = new AssemblyLibrary;
        $table->name = $request->name;
        $table->link = $request->link;
        $table->logo = $request->logo;
        $table->lang = app()->getLocale();

        if($request->hasFile('logo')){                   
                $imageName = time().'.'.$request->logo->extension();       
                $request->logo->move(public_path('uploads'), $imageName);
                $table->logo =  $imageName;             
        }else{
            $table->logo = $request->logo;
        }


        $table->save();
        return redirect()->route('assemblylibrary.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($ignore,$id)
    {
       
        $singleRow = AssemblyLibrary::find($id); 
        $allRows = AssemblyLibrary::all()->where('lang', app()->getLocale());
        return view('assemblylibrary', compact('allRows','singleRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ignore,Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $table = AssemblyLibrary::find($id);
        $table->name = $request->name;
        $table->link = $request->link;

        if($request->hasFile('logo')){                   
            $imageName = time().'.'.$request->logo->extension();       
            $request->logo->move(public_path('uploads'), $imageName);
            $table->logo =  $imageName;             
        }else{
            $table->logo = $table->logo;
        }

        $table->save();
        return redirect()->route('assemblylibrary.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = AssemblyLibrary::find($id);
        $singleRow->delete();
        return redirect()->route('assemblylibrary.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
