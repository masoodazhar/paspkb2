<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        //  $this->middleware('permission:super-admin-list|super-admin-create|super-admin-edit|super-admin-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:super-admin-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:super-admin-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:super-admin-delete', ['only' => ['destroy']]);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function mainindex()
     {
        $members = DB::table('members_directories')->count();
        $notification = DB::table('notifications')->count();
        $pressrelease = DB::table('press_releases')->count();
        $sessions = DB::table('sessions')->count();
        
        return view('index', compact('members','notification','pressrelease','sessions'));
     }

     public function index()
    {
        return redirect()->route('users.index', app()->getLocale()  );
    }
}
