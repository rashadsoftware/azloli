<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Owner;
use App\Models\User;

use Validator;

class ChatController extends Controller
{
    /*
	public function __construct(){
        $this->middleware('isLoggedOwner');
    }
    */
	
    /* index page 
    ==================================================================> */
    public function index(){
		if(session()->has('LoggedUser')){
			return redirect()->route('chat.login');
        } else {
            if(session()->has('LoggedOwner')){
                return redirect()->route('chat.users');
            } else {
                return view('chat.index');
            } 
		} 
    }
    public function indexPost(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=> 'required|min:3|max:20',
            'email'=>'required|email',
            'password'=> 'required|min:5|max:13',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $checkOwner=Owner::where('owner_email', $request->email)->first();
            if($checkOwner){
                return response()->json(['status'=>1, 'msg'=>'Bu hesaba bağlı bir email addressi var. Yenidən cəhd edin!']);
            } else {
                $owner=new Owner; 
                $owner->unique_id=\Request::ip();
                $owner->owner_username=$request->username;
                $owner->owner_email=$request->email;
                $owner->owner_password=Hash::make($request->password);
                $owner->save();

                return response()->json(['status'=>2]);
            }            
        }
    }
	
	/* login page 
    ==================================================================> */
    public function login(){
        if(session()->has('LoggedOwner')){
			return redirect()->route('chat.users');       
        } else {
            return view('chat.login'); 
        }        
    }
    public function loginPost(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=> 'required|min:5|max:13',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            if(session()->has('LoggedUser')){                
                $checkUser=User::where('user_email', '=', $request->email)->first();

                if($checkUser){
                    if(Hash::check($request->password, $checkUser->user_password)){
                        $request->session()->put('LoggedOwner', $checkUser->user_id);
                        return response()->json(['status'=>2]);
                    } else {
                        return response()->json(['status'=>1, 'msg'=>'Şifrə vəya E-mail yalnışdır. Yenidən cəhd edin!']);
                    }
                } else {
                    return response()->json(['status'=>1, 'msg'=>'Bu hesaba bağlı istifadəçi tapılmadı. Yenidən cəhd edin!']);
                }
            } else {
                $checkOwner=Owner::where('owner_email', '=', $request->email)->first();

                if($checkOwner){
                    if(Hash::check($request->password, $checkOwner->owner_password)){
                        $request->session()->put('LoggedOwner', $checkOwner->owner_id);
                        return response()->json(['status'=>2]);
                    } else {
                        return response()->json(['status'=>1, 'msg'=>'Şifrə vəya E-mail yalnışdır. Yenidən cəhd edin!']);
                    }
                } else {
                    return response()->json(['status'=>1, 'msg'=>'Bu hesaba bağlı istifadəçi tapılmadı. Yenidən cəhd edin!']);
                } 
            }
                      
        }
    }
	
	/* users page 
    ==================================================================> */
    public function users(){
        return view('chat.users'); 
    }
	
	/* chat page 
    ==================================================================> */
    public function chat(){
        return view('chat.chat'); 
    }
}
