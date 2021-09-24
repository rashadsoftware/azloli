<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('isLoggedProfile');
    }
    
    // index page =======================================================================>
    public function index(){
        return view('front.profile.index');       
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
