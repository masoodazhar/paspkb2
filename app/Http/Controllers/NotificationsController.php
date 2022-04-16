<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use DB;
class NotificationsController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:notifications-list|notifications-create|notifications-edit|notifications-delete', ['only' => ['index','store']]);
         $this->middleware('permission:notifications-create', ['only' => ['create','store']]);
         $this->middleware('permission:notifications-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:notifications-delete', ['only' => ['destroy']]);
    } 

    public function get_notifications($pages=false, $locale='en')
    {
        if($pages)
        {           
            $allRows = DB::table('notifications')
            ->where('page',$pages)
            ->where('lang',$locale)
            ->get();
            
        }else{
            $allRows = DB::table('notifications')
            ->where('lang',$locale)
            ->get();  
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
        $allRows = Notifications::all()->where('lang',app()->getLocale());
        return view('notifications', compact('allRows'));
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
            'subject' => 'required',
            'letterno' => 'required',
            'date' => 'required',
            'page' => 'required',
            'type'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = new Notifications;
        $table->subject = $request->subject;
        $table->letterno = $request->letterno;
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
        return redirect()->route('notifications.index')->with(['success'=>'Data has been Saved successfully']);
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
        
        $singleRow = Notifications::find($id); 
        $allRows = Notifications::all()->where('lang',app()->getLocale());

        return view('notifications', compact('allRows','singleRow'));
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
            'subject' => 'required',
            'letterno' => 'required',
            'date' => 'required',
            'page' => 'required',
            'type'=>  'required',
            'image_pdf_link' => 'required',
        ]);

        $table = Notifications::find($id);
        $table->subject = $request->subject;
        $table->letterno = $request->letterno;
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
        return redirect()->route('notifications.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $singleRow = Notifications::find($id);
        $singleRow->delete();
        return redirect()->route('notifications.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
