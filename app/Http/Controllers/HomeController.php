<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;
use App\Models\Message;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Jobs;
use App\Models\Skills;
use App\Models\Data;
use App\Models\Banner;

use Mail;
use Validator;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('OwnerOnline');
        $this->middleware('UserOnline');
    }

    // index page =======================================================================>
    public function index(){
        $config=Config::where('config_id', 1)->first();

        $banners=Banner::all();

        $dataOffers=Data::where('data_cat', 'offer')->get();
        $dataOfferImage=Data::where('data_cat', 'image')->where('data_key', 'offer')->first();

        return view('front.index', compact('config', 'banners', 'dataOffers', 'dataOfferImage'));       
    }

    // about page =======================================================================>
    public function about(){
        $config=Config::where('config_id', 1)->first();

        $dataOffers=Data::where('data_cat', 'offer')->get();
        $dataMissionImage=Data::where('data_cat', 'image')->where('data_key', 'mission')->first();
        $dataOfferImage=Data::where('data_cat', 'image')->where('data_key', 'offer')->first();

        return view('front.about', compact('config', 'dataOffers', 'dataMissionImage', 'dataOfferImage'));       
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

        $user=User::where('user_email', '=', $request->email)->where('user_status', 'user')->where('user_state', 'active')->first();

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
            'password'=> 'required|min:5|max:13|required_with:password_confirmation|same:password_confirmation',
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
                $user->user_state='active';
                $user->user_ip='';
                $user->user_address='';
                $user->user_phone='';
                $user->user_description='';
                $user->save();
                return redirect()->route('login')->with('successRegister', 'Təbriklər! Başarılı şəkildə qeydiyyatdan keçdiniz. Sistemə girmək üçün giriş edin zəhmət olmasa.');
            }
        } else {
            return back()->with('failRegister', 'Şifrə doğrulanması yalnışdır. Yenidən cəhd edin!');
        }        
    }
	
	// other page =======================================================================>
	public function search(Request $request){
		$config=Config::where('config_id', 1)->first();
		
		$data=$request->top_search_bar;

        $catCount=Category::where('category_seftitle', Str::slug($data))->where('category_state', 'active')->count();   
        $catID=Category::where('category_seftitle', Str::slug($data))->where('category_state', 'active')->first();    
                     
		if($catCount > 0){
			$skills=array();
            $workers=array();
            $publish=array();
			
			$skills_check=Skills::where('categoryID', $catID->category_id)->get();
            $skills_count=Skills::where('categoryID', $catID->category_id)->count();

            if($skills_count > 0){
                foreach($skills_check as $skillItem){
                    array_push($skills, $skillItem->userID);
                }
                
                $skill_users=array_unique($skills); // bir dizideki eyni deyerler birlesdi

                if(session()->has('LoggedUser')){
                    foreach($skill_users as $skill_user){
                        $worker_data=User::where('user_id',$skill_user)->where('user_status', 'user')->first();
    
                        if(session('LoggedUser') != $worker_data->user_id){
                            array_push($workers, $worker_data);
                            array_push($publish, $worker_data->user_publish);
                        }                    
                    }
                } else {
                    foreach($skill_users as $skill_user){
                        $worker_data=User::where('user_id',$skill_user)->where('user_status', 'user')->first();

                        array_push($workers, $worker_data);
                        array_push($publish, $worker_data->user_publish);                  
                    }
                }   

                $arr = array_diff($publish, array("unpublish"));

                return view('front.search', compact('data', 'config', 'catCount', 'workers', 'skills_count', 'catID', 'arr')); 	
            } else {
                return view('front.search', compact('data', 'config', 'catCount', 'skills_count', 'catID')); 	
            }	
		} else {
			return view('front.search', compact('data', 'config', 'catCount')); 
		}
    }
	
	public function userDetail($id){
		$config=Config::where('config_id', 1)->first();
		
		$userData=User::where('user_status', 'user')->where('user_id',$id)->where('user_publish', 'publish')->first();
		
		if($userData){
            $categoryID=array();
            $category=array();

            $skills=Skills::where('userID', $id)->get();

            $images=Jobs::where('userID', $id)->get();

            foreach($skills as $skill){                
                array_push($categoryID, $skill->categoryID);
            }

            $uniqCat=array_unique($categoryID);
            foreach($uniqCat as $categoryItem){   
                $userCategory=Category::where('category_id', $categoryItem)->first();

                array_push($category, $userCategory->category_title);
            }
			
			return view('front.user-detail', compact('config', 'userData', 'category', 'images')); 
		} else {
            return redirect()->route('index');
        }   
    }
	
	public function autocomplete(Request $request){
		if($request->get('query')){
            $query = $request->get('query');

            $data = Category::where('category_title', 'LIKE', "%{$query}%")->where('category_state', 'active')->get();

            $dataCount = Category::where('category_title', 'LIKE', "%{$query}%")->where('category_state', 'active')->count();

            if($dataCount > 0){
                $output = '<ul class="dropdown-menu w-100 ulCateList" style="display:block; position:relative">';
                foreach($data as $row){
                $output .= '
                    <li><a href="#">'.$row->category_title.'</a></li>
                ';
                }
                $output .= '</ul>';
                echo $output;
            }            
        }
    }
}
