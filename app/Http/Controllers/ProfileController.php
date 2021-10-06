<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;
use App\Models\Advert;

use Validator;

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

    // adverts page =======================================================================>
    public function adverts(){
        $config=Config::where('config_id', 1)->first();
		
        $advertsCompleted=Advert::where('advert_state', 'active')->get();
        $advertsCompletedCount=Advert::where('advert_state', 'active')->count();
		
        $advertsUncompleted=Advert::where('advert_state', 'passive')->get();
        $advertsUncompletedCount=Advert::where('advert_state', 'passive')->count();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
        return view('profile.adverts', compact('user', 'config', 'advertsCompleted', 'advertsCompletedCount', 'advertsUncompleted', 'advertsUncompletedCount'));
    }
	public function advertsDetail(Request $request, $seflink){
		$config=Config::where('config_id', 1)->first();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
		
		$checkAdvert=Advert::where('advert_seflink', $seflink)->where('advert_state', 'active')->first();
		
		if($checkAdvert){
			return view('profile.adverts-detail', compact('user', 'config', 'checkAdvert')); 
		} else {
			return  route('profile.adverts');
		} 
    }
	public function advertsUpdate(){
		
    }
	public function advertsDelete(){
		
    }

    // settings page =======================================================================>
    public function settings(){
        $config=Config::where('config_id', 1)->first();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
        return view('profile.settings', compact('user', 'config'));       
    }
    public function updateOptional(Request $request){
        $id=session('LoggedUser');

        $validator = Validator::make($request->all(),[
            'exampleUser' => 'required|min:3|max:100',
            'exampleEmail' => 'required|email',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $user=User::where('user_id', $id)->first();
            $user->user_name=$request->exampleUser;
            $user->user_email=$request->exampleEmail;
            $user->save();        
    
            return response()->json(['status'=>1, 'msg'=>'İstifadəçi profili başarılı şəkildə yeniləndi']);
        }        
    }
    public function updateImage(Request $request){
        $id=session('LoggedUser');

        $validator = Validator::make($request->all(),[
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);        

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $user=User::where('user_id', $id)->first();
            
            if($user->user_image != ''){
                $image_path = public_path().'/front/img/user/'.$user->user_image;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->user_image).'.'.$request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->move(public_path('front/img/user'), $newName);   
            $user->user_image=$newName;  
            $user->save();

            return response()->json(['status'=>1, 'msg'=>'İstifadəçi profili başarılı şəkildə yeniləndi']);
        }
    }
    public function updatePassword(Request $request){
        $id=session('LoggedUser');

        $validator = Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:15',
            'newpassword' => 'required|min:6|max:15',
            'password_confirmation' => 'required|min:6|max:15|confirmed',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $user=User::where('user_id', $id)->first();
            if(Hash::check($request->oldPassword, $user->user_password)){
                $user->user_password=Hash::make($request->newpassword);
                $user->save();        
    
                return response()->json(['status'=>1, 'msg'=>'İstifadəçi profili başarılı şəkildə yeniləndi']);
            } else {
                return response()->json(['status'=>2, 'msg'=>'Köhnə şifrə məlumat bazasındakı şifrə ilə uyğunlaşmır']);
            } 
        }        
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
