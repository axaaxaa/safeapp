<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Session;

class UserMiddleware
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

        if(empty(Session::get('user'))){
            return redirect('/login');
        }
        return $next($request);
    }
}
