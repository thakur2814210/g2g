<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use Session;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {

        $locale = 'en';

        if($request->session()->has('applocale')){
             $locale = $request->session()->get('applocale');
        }

        //if( Session::has('applocale')) {
          //  $locale = Session::get('applocale');
        //}

        \App::setlocale($locale);
        return $next($request);
     }
}
