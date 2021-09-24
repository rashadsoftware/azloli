<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;
use App\Models\Message;

use Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('isLoggedIP');
    }
    
    /* login page
    ==================================================================> */
    public function index(){
        
        if(session()->has('LoggedAdmin')){
			return redirect()->route('admin.dashboard');
        }

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
            $config=Config::where('config_id', 1)->first(); 
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

    /* profile page 
    ==================================================================> */
    public function profile(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        return view('admin.profile', compact('user'));
    }
    public function updateOptional(Request $request, $id){
        $request->validate([
            'exampleUser' => 'required|min:3|max:100',
            'exampleEmail' => 'required|email',
            'exampleUserIP' => 'required|min:3|max:100',
        ]);

        $user=User::findOrFail($id); 
        $user->user_name=$request->exampleUser;
        $user->user_email=$request->exampleEmail;
        $user->user_ip=$request->exampleUserIP;
        $user->save();        

        toastr()->success('İstifadəçi profili başarılı şəkildə yeniləndi', 'Təbriklər!');
        return redirect()->route('admin.profile');
    }
    public function updateImage(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $user=User::findOrFail($id);
            
            if($user->user_image != ''){
                $image_path = public_path().'/back/img/users/'.$user->user_image;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->user_image).'.'.$request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->move(public_path('back/img/users'), $newName);   
            $user->user_image=$newName;  
            $user->save();

            return response()->json(['status'=>1, 'msg'=>'İstifadəçi profili başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
    public function updatePassword(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:15',
            'newpassword' => 'required|min:6|max:15',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $user=User::findOrFail($id);
            if(Hash::check($request->oldPassword, $user->user_password)){
                $user->user_password=Hash::make($request->newpassword);
                $user->save();        
    
                return response()->json(['status'=>1]);
            } else {
                return response()->json(['status'=>2, 'msg'=>'Köhnə şifrə məlumat bazasındakı şifrə ilə uyğunlaşmır', 'state'=>'Təbriklər!']);
            } 
        }        
    }

    /* Message page 
    ==================================================================> */
    public function mail(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $configs=Config::where('config_id', 1)->first();
        $mails=Message::all();

        return view('admin.mail', compact('user', 'configs', 'mails'));
    }
    public function readMail($id){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }        

        $configs=Config::where('config_id', 1)->first();
        $detail=Message::where('mail_id', $id)->first();
        $detail->mail_read="read";
        $detail->save();

        return view('admin.read-mail', compact('user', 'configs', 'detail'));
    }
    public function deleteMail($id){
        Message::find($id)->delete();
        toastr()->success('İsmarıc başarılı şəkildə silindi', 'Təbriklər!');
        return redirect()->route('admin.mail'); 
    }
}
