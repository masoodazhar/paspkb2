<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\About;

class HomeApisController extends Controller
{
    function get_speakersmessages($locale='en'){
        $speakers = [];
        $speaker = DB::table('speakers_main')
        ->join('members_directories', 'members_directories.id','speakers_main.members_directories_id')  
        ->select('speakers_main.speakermessage','speakers_main.designation','members_directories.name','members_directories.image','members_directories.id')
        ->where('speakers_main.lang', $locale)
        ->get()
        ->first();

        $deputyspeaker = DB::table('deputy_speakers_main')
        ->join('members_directories', 'members_directories.id','deputy_speakers_main.members_directories_id')  
        ->select('deputy_speakers_main.speakermessage','deputy_speakers_main.designation','members_directories.name','members_directories.image','members_directories.id')
        ->where('deputy_speakers_main.lang', $locale)
        ->get()
        ->first();
        $speakers = [$speaker,$deputyspeaker];
        // dd($speakers);
        return response()->json($speakers);
    }

    public function get_sessionsorderoftheday($locale='en') {
        $allmainSessions = DB::table('order_of_the_day_summary_of_proceedings')  
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('main_sessions.*','assemblies.name')
        ->where('order_of_the_day_summary_of_proceedings.sittingstype', 'Order of the Day')
        ->where('order_of_the_day_summary_of_proceedings.lang', $locale)
        ->orderBy('main_sessions.id')
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,1000, true);

        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('order_of_the_day_summary_of_proceedings as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.sittingstype', 'Order of the Day')
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'sessionid'=>$msession->id,
                'assemblyname'=>$msession->name,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
        }
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_sessionssummery($locale='en') {
        $allmainSessions = DB::table('order_of_the_day_summary_of_proceedings')  
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('main_sessions.*','assemblies.name')
        ->where('order_of_the_day_summary_of_proceedings.sittingstype', 'Summary of Proceedings')
        ->where('order_of_the_day_summary_of_proceedings.lang', $locale)
        ->orderBy('main_sessions.id')
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,1000, true);

        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('order_of_the_day_summary_of_proceedings as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.sittingstype', 'Summary of Proceedings')
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'sessionid'=>$msession->id,
                'assemblyname'=>$msession->name,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
        }
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_sessionshouse($locale='en') {
        $allmainSessions = DB::table('order_of_the_day_summary_of_proceedings')  
        ->join('sessions', 'sessions.id', '=', 'order_of_the_day_summary_of_proceedings.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('main_sessions.*','assemblies.name')
        ->where('order_of_the_day_summary_of_proceedings.sittingstype', 'House Debates')
        ->where('order_of_the_day_summary_of_proceedings.lang', $locale)
        ->orderBy('main_sessions.id')
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,1000, true);

        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('order_of_the_day_summary_of_proceedings as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as orderid','ord.sittingstype','ord.sittingsno','ord.sittingsdate','ord.type', 'ord.description')
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.sittingstype', 'House Debates')
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'assemblyname'=>$msession->name,
                'sessionid'=>$msession->id,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
        }
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_sessionsresolution($locale='en') {
        $allmainSessions = DB::table('resolutions_passeds')  
        ->join('sessions', 'sessions.id', '=', 'resolutions_passeds.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('main_sessions.*','assemblies.name')
        ->where('resolutions_passeds.lang', $locale)
        ->orderBy('main_sessions.id')
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,1000, true);

        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('resolutions_passeds as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as resolutionid','ord.date as resolutiondate')
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'assemblyname'=>$msession->name,
                'sessionid'=>$msession->id,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
        }
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_sessionsquestion($locale='en') {
        $allmainSessions = DB::table('questions')  
        ->join('sessions', 'sessions.id', '=', 'questions.sessions_id')
        ->join('main_sessions', 'main_sessions.id', '=', 'sessions.main_sessions_id')
        ->join('assembly_tenures', 'assembly_tenures.id', '=', 'main_sessions.assembly_tenures_id')
        ->join('assemblies', 'assemblies.id', '=', 'assembly_tenures.assembly_id')
        ->select('main_sessions.*','assemblies.name')
        ->orderBy('main_sessions.id')
        ->where('questions.lang', $locale)
        ->get();
        $spg = $allmainSessions->unique('sessionname');
        $allmainSessions = array_slice($spg->values()->all(),0,1000, true);

        $allRows = [];
        foreach($allmainSessions as $msession){            
            $sessions = DB::table('questions as ord')
            ->join('sessions', 'sessions.id', '=', 'ord.sessions_id')
            ->select('sessions.*','ord.id as questionid', 'ord.date as questiondate')
            ->where('sessions.main_sessions_id', $msession->id)
            ->where('ord.lang', $locale)
            ->get();
            $sess = array(
                'sessionname'=>$msession->sessionname,
                'assemblyname'=>$msession->name,
                'sessionid'=>$msession->id,
                'listofsessions'=>$sessions
            );  
            array_push($allRows,$sess);
        }
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_pressrelease($locale='en'){
        $allRows = DB::table('press_releases')
        ->orderBy('id', 'desc')
        ->take(5)
        ->where('press_releases.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_newsandactivities($locale='en'){
        $allRows = DB::table('press_releases')
        ->orderBy('id', 'desc')
        ->where('page','News and Activities')
        ->where('image','<>','-')
        ->where('type','text')
        ->where('press_releases.lang', $locale)
        ->take(5)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    // public function get_newsandactivitiesAll(){
    //     $allRows = DB::table('press_releases')
    //     ->orderBy('id', 'desc')
    //     ->where('page','News and Activities')
    //     ->where('image','<>','-')
    //     ->where('type','text')
    //     ->get();
    //     // dd($allRows);
    //     return response()->json($allRows);
    // }

    public function get_notificationGeneral($locale='en'){
        $allRows = DB::table('notifications')
        ->orderBy('id', 'desc')
        ->take(3)
        ->select('notifications.subject','notifications.letterno','notifications.date','notifications.type')
        ->where('page', 'General')
        ->where('notifications.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_notificationSessions($locale='en'){
        $allRows = DB::table('notifications')
        ->orderBy('id', 'desc')
        ->take(3)
        ->select('notifications.subject','notifications.letterno','notifications.date','notifications.type')
        ->where('page', 'Sessions')
        ->where('notifications.lang', $locale)        
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_notificationMembers($locale='en'){
        $allRows = DB::table('notifications')
        ->orderBy('id', 'desc')
        ->take(3)
        ->select('notifications.subject','notifications.letterno','notifications.date','notifications.type')
        ->where('notifications.lang', $locale)
        ->where('page', 'Members')
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }

    public function get_notificationCommittees($locale='en'){
        $allRows = DB::table('notifications')
        ->orderBy('id', 'desc')
        ->take(3)
        ->select('notifications.subject','notifications.letterno','notifications.date','notifications.type')
        ->where('page', 'Committees')
        ->where('notifications.lang', $locale)
        ->get();
        // dd($allRows);
        return response()->json($allRows);
    }
}
