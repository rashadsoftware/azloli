<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedInAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if( session()->has('LoggedAdmin')  && route('admin.index') == $request->url() ){
            return back();
        }
        
        return $next($request);
    }
}
