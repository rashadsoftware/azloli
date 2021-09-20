<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

class CheckIPAddress
{
    public function handle(Request $request, Closure $next)
    {
        $user = DB::table('users')->first();
        if ($request->ip() != $user->user_ip) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
