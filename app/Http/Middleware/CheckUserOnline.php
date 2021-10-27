<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;
use Session;

class CheckUserOnline
{
    public function handle(Request $request, Closure $next)
    {
        $ip=\Request::ip();
        $checkIPUser=User::where('user_ip', $ip)->where('user_status', 'user')->first();

        if(session()->has('LoggedUser')){
            $requestUser=$checkIPUser->user_id;
            if(Session::get('LoggedUser') != $requestUser){
                $checkIPUser->user_online='offline';
                $checkIPUser->save();
            }
        } else {
            $checkIPUser->user_online='offline';
            $checkIPUser->save();
        } 

        return $next($request);
    }
}
