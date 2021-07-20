<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //if (Auth::guard($guard)->check()) {
          //  return redirect('/home');
       // }

         switch ($guard)
        {

            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('superadmin.dashboard');
              }
              break;
            /*case 'superadmin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('superadmin.dashboard');
              }
              break;*/
            case 'client':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('client.dashboard');
              }
              break;

            case 'garage':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('garage.dashboard');
              }
              break;
            case 'vendor':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('vendor.dashboard');
              }
              break;
            default:
              if (Auth::guard($guard)->check()) {
                  return redirect()->route('page.homepage');
              }
              break;
        }

        return $next($request);

        return $next($request);
    }
}
