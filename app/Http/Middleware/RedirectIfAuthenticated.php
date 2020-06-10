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
        
        // dd($guard);

        switch ($guard) {
            //for admins : table `users`
            case 'client-web':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
            
            //for normal users : table `clients`
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('adminHome');
                }
                break;
        }

        return $next($request);
    }
}
