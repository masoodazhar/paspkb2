<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicAccountsCommittee;
use App\Models\MembersDirectory;
use DB;

class PublicAccountsCommitteeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:public-accounts-committee-list|public-accounts-committee-create|public-accounts-committee-edit|public-accounts-committee-delete', ['only' => ['index','store']]);
         $this->middleware('permission:public-accounts-committee-create', ['only' => ['create','store']]);
         $this->middleware('permission:public-accounts-committee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:public-accounts-committee-delete', ['only' => ['destroy']]);
    } 

    public function get_publicaccountscommittee($page, $locale='en')
    {
        
        $allRows = DB::table('public_accounts_committees')
        ->select('*')
        ->where('page',$page)
        ->where('lang',$locale)
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
        $allRows = PublicAccountsCommittee::all()->where('lang',app()->getLocale());
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());        
        return view('publicaccountscommittee', compact('allRows','membersDirectories'));
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
            'heading' => 'required',
            'tab_type' => 'required',
            'date' => 'required',
            'page' => 'required',
            'type' => 'required',
            'image_pdf_link' => 'required',
        ]);

        $table = new PublicAccountsCommittee;
        $table->heading = $request->heading;
        $table->tab_type = $request->tab_type;
        $table->date = $request->date;
        $table->page = $request->page;
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
        return redirect()->route('publicaccountscommittee.index')->with(['success'=>'Data has been Saved successfully']);
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
    public function edit($ignore, $id)
    {
        $singleRow = PublicAccountsCommittee::find($id);

        $allRows = PublicAccountsCommittee::all()->where('lang',app()->getLocale());
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        return view('publicaccountscommittee', compact('singleRow','allRows','membersDirectories'));
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
                'tab_type' => 'required',
                'date' => 'required',
                'page' => 'required',
                'type' => 'required',
                'image_pdf_link' => 'required',
            ]);
    
            $table = PublicAccountsCommittee::find($id);
            $table->heading = $request->heading;
            $table->tab_type = $request->tab_type;
            $table->date = $request->date;
            $table->page = $request->page;
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
            
        
        
        return redirect()->route('publicaccountscommittee.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $table = PublicAccountsCommittee::find($id);
        $table->delete();
        return redirect()->route('publicaccountscommittee.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
