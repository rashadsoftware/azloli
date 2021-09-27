<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Config;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('isLoggedProfile');
    }
    
    // index page =======================================================================>
    public function index(){
        $config=Config::where('config_id', 1)->first();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
        return view('profile.index', compact('user', 'config'));       
    }

    // settings page =======================================================================>
    public function settings(){
        $config=Config::where('config_id', 1)->first();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
        return view('profile.settings', compact('user', 'config'));       
    }

    /* logout page 
    ==================================================================> */
    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->route('login');
        }
    }
}
