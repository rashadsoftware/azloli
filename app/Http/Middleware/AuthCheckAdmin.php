<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedAdmin')){
            return redirect()->route('admin.index')->with('fail', 'Admin panelə girmək üçün giriş etməlisiniz');
        }

        return $next($request);
    }
}
