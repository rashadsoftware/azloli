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
            'message'=>'required|min:5',
        ]);        

        $fullname=$request->name.' '.$request->surname;

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $mail=new Message; 
            $mail->mail_user=$fullname;
            $mail->mail_email=$request->email;
            
            if ($request->filled('phone')) {
                $validatorPhone = Validator::make($request->all(),[
                    'phone'=>'regex:/^0[0-9]{9}/i|numeric'
                ]);
    
                if(!$validatorPhone->passes()){
                    return response()->json(['status'=>0, 'error'=>$validatorPhone->errors()->toArray()]);
                }
    
                $mail->mail_phone=$request->phone;
            } else {
                $mail->mail_phone='';
            }
    
            if ($request->filled('theme')) {
                $validatorTheme = Validator::make($request->all(),[
                    'theme'=>'min:2|max:300'
                ]);
    
                if(!$validatorTheme->passes()){
                    return response()->json(['status'=>0, 'error'=>$validatorTheme->errors()->toArray()]);
                }
    
                $mail->mail_theme=$request->theme;
            } else {
                $mail->mail_theme='';
            }
            
            $mail->mail_text=$request->message;
            $mail->save();        

            return response()->json(['status'=>1, 'msg'=>'Mesajınız başarılı şəkildə göndərildi']);
        }
    }
	
	// login page =======================================================================>
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

    // register page =======================================================================>
    public function register(){
		if(session()->has('LoggedUser')){
			return redirect()->route('profile.dashboard');       
        }
		
        $config=Config::where('config_id', 1)->first();

        return view('front.register', compact('config'));       
    }
    public function registerPost(Request $request){
        $request->validate([
            'username'=>'required|string|min:2|max:50',
            'email'=>'required|email',
            'password'=> 'required|min:5|max:13',
            'password_confirmation'=> 'required|min:5|max:13'
        ]);

        if($request->password == $request->password_confirmation){
            $checkUser=User::where('user_email', $request->email)->where('user_status', 'user')->first();

            if($checkUser){
                return back()->with('failRegister', 'Bu hesab qeydiyyatdan keçmişdir. Yenidən cəhd edin!');
            } else {
                $user=new User; 
                $user->user_name=$request->username;
                $user->user_image='';
                $user->user_email=$request->email;
                $user->user_password=Hash::make($request->password);
                $user->user_status='user';
                $user->user_state='active';
                $user->user_ip='';
                $user->save();
                return redirect()->route('login')->with('successRegister', 'Təbriklər! Başarılı şəkildə qeydiyyatdan keçdiniz. Sistemə girmək üçün giriş edin zəhmət olmasa.');;
            }
        } else {
            return back()->with('failRegister', 'Şifrə doğrulanması yalnışdır. Yenidən cəhd edin!');
        }        
    }
}
