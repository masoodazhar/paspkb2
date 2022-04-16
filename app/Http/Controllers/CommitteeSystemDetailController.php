<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommitteeSystemDetail;
use DB;
class CommitteeSystemDetailController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:committee-system-detail-list|committee-system-detail-create|committee-system-detail-edit|committee-system-detail-delete', ['only' => ['index','store']]);
         $this->middleware('permission:committee-system-detail-create', ['only' => ['create','store']]);
         $this->middleware('permission:committee-system-detail-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:committee-system-detail-delete', ['only' => ['destroy']]);
    } 
    public function get_committeesystemdetail($locale='en')
    {
        $allRows = DB::table('committee_system_details')->where('lang', $locale)->get();
        // dd($allRows);
        return response()->json($allRows);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRows = CommitteeSystemDetail::all()->where('lang',app()->getLocale());
        return view('committeesystemdetail', compact('allRows'));
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
            'heading' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);
           

        $table = new CommitteeSystemDetail;
        $table->heading = $request->heading;
        if($request->hasFile('description')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->description->extension();       
                $request->description->move(public_path('uploads'), $imageName);
                $table->description =  $imageName;             
            }else{
                $table->description = $request->description;
            }
        }else{
            $table->description = $request->description;
        }
        $table->type = $request->type;
        $table->lang = app()->getLocale();
        
        $table->save();
        return redirect()->route('committeesystemdetail.index')->with(['success'=>'Data has been Saved successfully']);
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
       
        $singleRow = CommitteeSystemDetail::find($id); 
        $allRows = CommitteeSystemDetail::all();
        return view('committeesystemdetail', compact('allRows','singleRow'));
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
            'heading' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        $table = CommitteeSystemDetail::find($id);
        $table->heading = $request->heading;
        
        $table->type = $request->type;

        if($request->hasFile('description')){
            if($request->type=='pdf' || $request->type=='jpg' || $request->type=='png'){            
                $imageName = time().'.'.$request->description->extension();       
                $request->description->move(public_path('uploads'), $imageName);
                $table->description =  $imageName;             
            }else{
                $table->description = $request->description;
            }
        }else{
            $table->description = $request->description;
        }


        $table->save();
        return redirect()->route('committeesystemdetail.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = CommitteeSystemDetail::find($id);
        $singleRow->delete();
        return redirect()->route('committeesystemdetail.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
