<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckProfile
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser')){
            return redirect()->route('login')->with('failLogin', 'Profilə girmək üçün giriş etməlisiniz');   
        }

        return $next($request);
    }
}
