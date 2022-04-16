<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\MembersDirectory;
use App\Models\PublicAccountsCommitteeMember;

class PublicAccountsCommitteeMemberController extends Controller
{
    
    public function get_publicaccountscommitteemembers($page, $locale='en')
    {
        $result = DB::table('public_accounts_committee_members')
        ->join('members_directories', 'members_directories.id', '=', 'public_accounts_committee_members.member_chairman')
        ->select('public_accounts_committee_members.members_directories_id','members_directories.*')
        ->where('public_accounts_committee_members.page', $page)
        ->where('public_accounts_committee_members.lang', $locale)
        ->count();
        $allRows = array();
        
        if($result){
            $main = DB::table('public_accounts_committee_members')
            ->join('members_directories', 'members_directories.id', '=', 'public_accounts_committee_members.member_chairman')
            ->select('public_accounts_committee_members.members_directories_id','members_directories.*')
            ->where('public_accounts_committee_members.page', $page)
            ->where('public_accounts_committee_members.lang', $locale)
            ->first();
            // print_r(json_decode($m->members_directories_id));
            $members = DB::table('members_directories')
            ->select('members_directories.*')
            ->whereIn('members_directories.id',json_decode($main->members_directories_id))
            ->where('members_directories.lang', $locale)
            ->get();
            array_push($allRows,  array('data'=>$main, 'members'=> $members));
        }else{
            array_push($allRows,  array('data'=>false, 'members'=> []));
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

        $allRows = array();
        $main = DB::table('public_accounts_committee_members')
        ->join('members_directories', 'members_directories.id', '=', 'public_accounts_committee_members.member_chairman')
        ->select('public_accounts_committee_members.*','members_directories.name')
        ->where('public_accounts_committee_members.lang',app()->getLocale())
        ->get();

        foreach($main as $m){
            // print_r(json_decode($m->members_directories_id));
            $members = DB::table('members_directories')
            ->select('members_directories.name')
            ->whereIn('members_directories.id',json_decode($m->members_directories_id))
            ->get();
            // $this->allRows = array('members'=> $members);
            array_push($allRows,  array('data'=>$m, 'members'=> $members));
        }
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());        
        return view('publicaccountscommitteemember', compact('allRows','membersDirectories'));
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
            'members_directories_id',
            'page',
            'member_chairman'
        ]);

        $table = new PublicAccountsCommitteeMember;
        $table->member_chairman = $request->member_chairman;
        $table->page = $request->page;
        $table->lang = app()->getLocale();
        $table->members_directories_id = json_encode($request->members_directories_id);
     
        $table->save();
        return redirect()->route('publicaccountscommitteemember.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = PublicAccountsCommitteeMember::find($id);
        $allRows = array();
        $main = DB::table('public_accounts_committee_members')
        ->join('members_directories', 'members_directories.id', '=', 'public_accounts_committee_members.member_chairman')
        ->select('public_accounts_committee_members.*','members_directories.name')
        ->where('public_accounts_committee_members.lang',app()->getLocale())
        ->get();

        foreach($main as $m){
            // print_r(json_decode($m->members_directories_id));
            $members = DB::table('members_directories')
            ->select('members_directories.name')
            ->whereIn('members_directories.id',json_decode($m->members_directories_id))
            ->get();
            // $this->allRows = array('members'=> $members);
            array_push($allRows,  array('data'=>$m, 'members'=> $members));
        }
        // $allRows = PublicAccountsCommitteeMember::all();
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        return view('publicaccountscommitteemember', compact('singleRow','allRows','membersDirectories'));
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
            'members_directories_id',
            'page',
            'member_chairman'
        ]);

        $table = PublicAccountsCommitteeMember::find($id);
        $table->member_chairman = $request->member_chairman;
        $table->page = $request->page;
        if($request->members_directories_id){
            $table->members_directories_id = json_encode($request->members_directories_id);
        }
        $table->save();
        return redirect()->route('publicaccountscommitteemember.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $table = PublicAccountsCommitteeMember::find($id);
        $table->delete();   
        return redirect()->route('publicaccountscommitteemember.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
