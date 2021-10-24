<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Owner;
use Session;

class CheckOwnerOnline
{
    public function handle(Request $request, Closure $next)
    {
        $ip=\Request::ip();

        $checkIPOwner=Owner::where('unique_id', $ip)->first();
        if($checkIPOwner){
            $requestOwner=$checkIPOwner->owner_id;

            if(Session::get('LoggedOwner') != $requestOwner){
                $checkIPOwner->owner_online='offline';
                $checkIPOwner->save();
            }
        }  

        return $next($request);
    }
}
