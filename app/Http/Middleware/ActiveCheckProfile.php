<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ActiveCheckProfile
{
    public function handle(Request $request, Closure $next)
    {
        $user = DB::table('users')->where('user_id', session('LoggedUser'))->first();

        if($user->user_state == 'passive'){
            session()->pull('LoggedUser');
            return redirect()->route('login')->with('failLogin', 'Profil hesabınız aktiv deyil. Sayt administratoruna müraciət edin!');   
        }

        return $next($request);
    }
}
