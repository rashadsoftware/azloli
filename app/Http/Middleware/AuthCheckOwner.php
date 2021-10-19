<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckOwner
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedOwner')){
            return redirect()->route('chat.login')->with('failOwner', 'Canlı söhbətə girmək üçün giriş etməlisiniz');
        }

        return $next($request);
    }
}
