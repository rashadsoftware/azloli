<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;

use Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('isLoggedIP');
    }
    
    // login page
    public function index(){
        return view('admin.index');
    }
    public function indexPost(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=> 'required|min:5|max:13'
        ]);

        $user=User::where('user_email', '=', $request->email)->where('user_status', '=', 'admin')->first();

        if($user){
            if(Hash::check($request->password, $user->user_password)){
                $request->session()->put('LoggedAdmin', $user->user_id);
                toastr()->success('Yenidən xoşgəldiniz', 'Bildiriş!');
                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('fail', 'Şifrə vəya E-mail yalnışdır. Yenidən cəhd edin!');
            }
        } else {
            return back()->with('fail', 'Bu hesab üçün istifadəçi tapılmadı');
        }
    }

    /* logout page 
    ==================================================================> */
    public function logout(){
        if(session()->has('LoggedAdmin')){
            session()->pull('LoggedAdmin');
            return redirect()->route('admin.index');
        }
    }

    /* dashboard page 
    ==================================================================> */
    public function dashboard(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        return view('admin.dashboard', compact('user'));
    }

    /* settings page 
    ==================================================================> */
    public function settings(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $configs=Config::where('config_id', 1)->first();

        return view('admin.settings', compact('user', 'configs'));
    }
    public function ajaxOptional(Request $request){
        $validator = Validator::make($request->all(),[
            'companyTitle'=>'required|min:2|max:15',
            'companyEmail'=>'required|email',
            'companyPhone'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'companyAddress'=>'required|min:5|max:100',
            'companyDescription'=>'required|min:5|max:1000',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $id=1;
            $config=Config::findOrFail($id); 
            $config->config_title=$request->companyTitle;
            $config->config_email=$request->companyEmail;
            $config->config_phone=$request->companyPhone;
            $config->config_address=$request->companyAddress;
            $config->config_description=$request->companyDescription;
            $config->save();        

            return response()->json(['status'=>1, 'msg'=>'Şirkət məlumatları başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
    public function ajaxLogo(Request $request){ 
        $validator = Validator::make($request->all(),[
            'companyLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $config=Config::where('config_id', 1)->first();
            
            if($config->config_logo != ''){
                $image_path = public_path().'/front/img/'.$config->config_logo;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->companyLogo).'.'.$request->file('companyLogo')->getClientOriginalExtension();
            $request->file('companyLogo')->move(public_path('front/img'), $newName);   
            $config->config_logo=$newName;  
            $config->save(); 

            return response()->json(['status'=>1, 'msg'=>'Şirkət məlumatları başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
    public function ajaxFavicon(Request $request){
        $validator = Validator::make($request->all(),[
            'companyFavicon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $config=Config::where('config_id', 1)->first();
            
            if($config->config_favicon != ''){
                $image_path = public_path().'/front/img/'.$config->config_favicon;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->companyFavicon).'.'.$request->file('companyFavicon')->getClientOriginalExtension();
            $request->file('companyFavicon')->move(public_path('front/img'), $newName);   
            $config->config_favicon=$newName;  
            $config->save();  

            return response()->json(['status'=>1, 'msg'=>'Şirkət məlumatları başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
    public function ajaxSocial(Request $request){
        $validator = Validator::make($request->all(),[
            'companyFacebook'=>'required|url',
            'companyInstagram'=>'required|url',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $id=1;
            $config=Config::findOrFail($id); 
            $config->config_facebook=$request->companyFacebook;
            $config->config_instagram=$request->companyInstagram;
            $config->save();        

            return response()->json(['status'=>1, 'msg'=>'Şirkət məlumatları başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
}
