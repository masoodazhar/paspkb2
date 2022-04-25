<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\MembersDirectory;
use App\Models\OtherCommitteeMember;
use App\Models\OtherCommittee;

class OtherCommitteeMemberController extends Controller
{
    public function get_publicaccountscommitteemembers($page, $locale='en')
    {
        $result = DB::table('other_committee_member')
        ->join('members_directories', 'members_directories.id', '=', 'other_committee_member.member_chairman')
        ->select('other_committee_member.members_directories_id','members_directories.*')
        ->where('other_committee_member.page', $page)
        ->where('other_committee_member.lang', $locale)
        ->count();
        $allRows = array();

        if($result){
            $main = DB::table('other_committee_member')
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
        $main = DB::table('other_committee_member')
        ->join('members_directories', 'members_directories.id', '=', 'other_committee_member.member_chairman')
        ->join('other_committies', 'other_committies.id', '=', 'other_committee_member.page')
        ->select('other_committee_member.*','members_directories.name', 'other_committies.name as committeename')
        ->where('other_committee_member.lang',app()->getLocale())
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
        $otherCommitteeHeading = OtherCommittee::all()->where('lang',app()->getLocale());

        return view('othercommitteemember', compact('allRows','membersDirectories', 'otherCommitteeHeading'));
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

        $table = new OtherCommitteeMember;
        $table->member_chairman = $request->member_chairman;
        $table->page = $request->page;
        $table->lang = app()->getLocale();
        $table->members_directories_id = json_encode($request->members_directories_id);

        $table->save();
        return redirect()->route('othercommitteemember.index')->with(['success'=>'Data has been Saved successfully']);
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
        $singleRow = OtherCommitteeMember::find($id);
        $allRows = array();
        $main = DB::table('other_committee_member')
        ->join('members_directories', 'members_directories.id', '=', 'other_committee_member.member_chairman')
        ->join('other_committies', 'other_committies.id', '=', 'other_committee_member.page')
        ->select('other_committee_member.*','members_directories.name', 'other_committies.name as committeename')
        ->where('other_committee_member.lang',app()->getLocale())
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
        // $allRows = OtherCommitteeMember::all();
        $otherCommitteeHeading = OtherCommittee::all()->where('lang',app()->getLocale());
        $membersDirectories = MembersDirectory::all()->where('lang',app()->getLocale());
        return view('othercommitteemember', compact('singleRow','allRows','membersDirectories', 'otherCommitteeHeading'));
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

        $table = OtherCommitteeMember::find($id);
        $table->member_chairman = $request->member_chairman;
        $table->page = $request->page;
        if($request->members_directories_id){
            $table->members_directories_id = json_encode($request->members_directories_id);
        }
        $table->save();
        return redirect()->route('othercommitteemember.index')->with(['success'=>'Data has been Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ignore, $id)
    {
        $table = OtherCommitteeMember::find($id);
        $table->delete();
        return redirect()->route('othercommitteemember.index')->with(['success'=>'Data has been Deleted successfully']);
    }
}
