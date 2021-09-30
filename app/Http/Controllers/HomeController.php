<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Config;
use App\Models\Message;

use Mail;
use Validator;

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
    public function contactPost(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:2|max:50|string',
            'surname'=>'required|min:2|max:100|string',
            'email'=>'required|email',
            'phone'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'theme'=>'required|min:2|max:300',
            'message'=>'required|min:5',
        ]);

        $fullname=$request->name.' '.$request->surname;

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $mail=new Message; 
            $mail->mail_user=$fullname;
            $mail->mail_email=$request->email;
            $mail->mail_phone=$request->phone;
            $mail->mail_theme=$request->theme;
            $mail->mail_text=$request->message;
            $mail->save();        

            return response()->json(['status'=>1, 'msg'=>'Mesajınız başarılı şəkildə göndərildi']);
        }
    }
	
	// contact page =======================================================================>
    public function login(){
		if(session()->has('LoggedUser')){
			return redirect()->route('profile.dashboard');       
        }
		
        $config=Config::where('config_id', 1)->first();

        return view('front.login', compact('config'));       
    }
    public function loginPost(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=> 'required|min:5|max:13'
        ]);

        $user=User::where('user_email', '=', $request->email)->where('user_status', 'user')->first();

        if($user){
            if(Hash::check($request->password, $user->user_password)){
                $request->session()->put('LoggedUser', $user->user_id);
                return redirect()->route('profile.dashboard');
            } else {
                return back()->with('failLogin', 'Şifrə vəya E-mail yalnışdır. Yenidən cəhd edin!');
            }
        } else {
            return back()->with('failLogin', 'Bu hesab üçün istifadəçi tapılmadı');
        }
    }
}
