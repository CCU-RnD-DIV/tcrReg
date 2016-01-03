<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GeneralAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('generalLogin');
            }
        }elseif (Auth::user()->type != 'primary' && Auth::user()->type != 'junior' ) {

            return redirect()->guest('generalLogin');

        }elseif (Auth::user()->reg_verify == 0) {

            /*
             * If they haven't finished their Verification
             */

            return redirect()->guest('/verify');

        }elseif (Auth::user()->reg_verify == 2) {

            /*
             * If they forgot their Password
             */

            return redirect()->guest('/reset-verify');

        }else{

            return $next($request);

        }
    }
}
