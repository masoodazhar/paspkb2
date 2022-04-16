<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use URL;
use Config;

class Localization
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next)
    {        
        // $locale = Request::segment(1);

        // if(in_array($locale, ['en','ur','sd'])){
        //     app()->setLocale($locale);
        // }else{
        //     app()->setLocale('en');

        //     $locale = '';
        // }

        URL::defaults(['locale' => $request->segment(1)]);
        app()->setLocale($request->segment(1));
        return $next($request);
        
        
    }
}