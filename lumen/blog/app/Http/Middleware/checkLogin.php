<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
// use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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

         if(Auth::check() && Auth::user()->role_id > 5 ){
            return $next($request);
        }else
        return response(['error'=>['Unauthorized.']], 401);
    }
}
/*
Middleware : chek auth
true-> next request =
- Controller : generate token reuturn user + token
false -> return login fail

*/