<?php

namespace App\Http\Middleware;

use App\Repository\UserRepository\User;
use Closure;
use App\Repository\UserRepository\UserRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class check_login
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
//        dd(UserRepository::is_logged_in());
        if(!UserRepository::is_logged_in()) {;
            Session::put('error',"Please Login to View this page");
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
