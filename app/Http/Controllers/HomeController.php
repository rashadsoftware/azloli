<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    // index page =======================================================================>
    public function index(){
        $config=Config::where('config_id', 1)->first();

        return view('front.index', compact('config'));       
    }

    // about page =======================================================================>
    public function about(){
        $config=Config::where('config_id', 1)->first();

        return view('front.about', compact('config'));       
    }

    // service page =======================================================================>
    public function service(){
        $config=Config::where('config_id', 1)->first();

        return view('front.service', compact('config'));       
    }

    // contact page =======================================================================>
    public function contact(){
        $config=Config::where('config_id', 1)->first();

        return view('front.contact', compact('config'));       
    }
}
