<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\thesindhtrans2016;
class thesindhtrans2016Controller extends Controller
{
    function __construct()
    {
         $this->middleware('permission:the-sindh-trans2016-list|the-sindh-trans2016-create|the-sindh-trans2016-edit|the-sindh-trans2016-delete', ['only' => ['index','store']]);
         $this->middleware('permission:the-sindh-trans2016-create', ['only' => ['create','store']]);
         $this->middleware('permission:the-sindh-trans2016-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:the-sindh-trans2016-delete', ['only' => ['destroy']]);
    }

    public function get_thesindhtrans2016($id=false, $locale='en')
    {
        if(is_numeric($id)){
            
            $allRows = DB::table('thesindhtrans2016smain')->select('*')->where('lang', $locale)->where('theid',1)->get()->first();
        }else{
            $allRows = DB::table('thesindhtrans2016s')->where('lang', $locale)->get();
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
        // $singleRowMain = DB::table('thesindhtrans2016smain')
        // ->where(array('id'=>1))
        // ->first();
        $singleRowMain = DB::table('thesindhtrans2016smain')->select('*')->where('lang',app()->getLocale())->where('theid',1)->first();
        $allRows = thesindhtrans2016::all()->where('lang', app()->getLocale());
        return view('thesindhtrans2016', compact('allRows','singleRowMain'));
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

        $table = new thesindhtrans2016;
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
        return redirect()->route('thesindhtrans2016.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRowMain = DB::table('thesindhtrans2016smain')->select('*')->where('lang',app()->getLocale())->where('id',1)->first();

        $singleRow = thesindhtrans2016::find($id); 
        $allRows = thesindhtrans2016::all()->where('lang', app()->getLocale());
        return view('thesindhtrans2016', compact('allRows','singleRow','singleRowMain'));
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
        if($request->check=='true'){
            $request->validate([
                'subject' => 'required',
                'actno' => 'required',
                'passedon' => 'required',
                'dateofenforcement' => 'required',
            ]);
    
            DB::update('update thesindhtrans2016smain set subject=?, actno=?, passedon=?, dateofenforcement=?  where id = ?',
            [$request->subject, $request->actno, $request->passedon, $request->dateofenforcement,$id]);
        
        }else{
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'image_pdf_link' => 'required'
            ]);
            
            $table = thesindhtrans2016::find($id);
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
        } 
        return redirect()->route('thesindhtrans2016.index')->with(['success'=>'Data has been Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore,$id)
    {
        $singleRow = thesindhtrans2016::find($id);
        $singleRow->delete();
        return redirect()->route('thesindhtrans2016.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
