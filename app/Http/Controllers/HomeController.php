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
use App\Models\Advert;
use App\Models\Checks;
use App\Models\PasswordReset;
use App\Models\AdvertImage;

use Mail;
use Validator;

use App\Mail\ForgetPasswordMail;
use Carbon\Carbon;

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

            return response()->json(['status'=>1, 'msg'=>'Mesaj??n??z ba??ar??l?? ????kild?? g??nd??rildi']);
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
                return back()->with('failLogin', '??ifr?? v??ya E-mail yaln????d??r. Yenid??n c??hd edin!');
            }
        } else {
            return back()->with('failLogin', 'Bu hesab ??????n istifad????i tap??lmad??');
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
                return back()->with('failRegister', 'Bu hesab qeydiyyatdan ke??mi??dir. Yenid??n c??hd edin!');
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
                return redirect()->route('login')->with('successRegister', 'T??brikl??r! Ba??ar??l?? ????kild?? qeydiyyatdan ke??diniz. Sistem?? girm??k ??????n giri?? edin z??hm??t olmasa.');
            }
        } else {
            return back()->with('failRegister', '??ifr?? do??rulanmas?? yaln????d??r. Yenid??n c??hd edin!');
        }        
    }
	
	// other page =======================================================================>
	public function search(Request $request){
		$config=Config::where('config_id', 1)->first();
		
		$data=$request->top_search_bar;

        $catCount=SubCategory::where('subcategory_seftitle', Str::slug($data))->where('subcategory_state', 'active')->count();   
        $catID=SubCategory::where('subcategory_seftitle', Str::slug($data))->where('subcategory_state', 'active')->first();    
                     
		if($catCount > 0){
			$skills=array();
            $workers=array();
            $publish=array();
			
			$skills_check=Skills::where('subcategoryID', $catID->subcategory_id)->get();
            $skills_count=Skills::where('subcategoryID', $catID->subcategory_id)->count();

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

            $dataSub = SubCategory::where('subcategory_title', 'LIKE', "%{$query}%")->where('subcategory_state', 'active')->get();
            $dataSubCount = SubCategory::where('subcategory_title', 'LIKE', "%{$query}%")->where('subcategory_state', 'active')->count();

            if($dataSubCount > 0){
                $output = '<ul class="dropdown-menu w-100 ulCateList" style="display:block; position:relative; ">';
                foreach($dataSub as $row){
                $output .= '
                    <li>
                        <a href="#">'.$row->subcategory_title.'</a>      
                    </li>';
                }
                $output .= '</ul>';
                echo $output;
            }         
        }
    }

    public function skillsFetch(Request $request){
        
        $districtsCount=SubCategory::where('categoryID', '=', $request->cateID)->count();
        $districtsFetch=SubCategory::where('categoryID', '=', $request->cateID)->pluck('subcategory_title', 'subcategory_id');
        
        if($districtsCount > 0){
            return response(['status'=>'success', 'content'=>$districtsFetch]);
        } else {
            return response(['status'=>'error', 'content'=>'Alt kateqoriya se??iniz']);
        }        
    }

    public function advertCreate(Request $request){
		$ip=\Request::ip();
		
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:2|max:50|string',
            'surname'=>'required|min:2|max:50|string',
            'title'=>'required|min:3|max:200',
            'selectCategory'=>'required',
            'selectSubcategory'=>'required',
            'phone'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'message'=>'required|min:5',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $advert=new Advert; 
            $advert->advert_name=$request->name." ".$request->surname;
            $advert->advert_title=$request->title;
            $advert->unique_id=$ip;
            $advert->advert_category=$request->selectCategory;
            $advert->advert_subcategory=$request->selectSubcategory;
            $advert->advert_phone=$request->phone;
            $advert->advert_description=$request->message;
            $advert->advert_count="0";
               
            
            if($request->hasfile('imageFile')) {
                foreach($request->file('imageFile') as $file){
                    $name = Str::slug($request->title).'_'.$file->getClientOriginalName();
                    $file->move(public_path('front/img/adverts'), $name);  
                    $imgData[] = $name;  
                }

                $advert->advert_images = json_encode($imgData);
            } else {
                $advert->advert_images = '';
            }

            $advert->save();

            return response()->json(['status'=>1, 'msg'=>'Sor??unuz ba??ar??l?? ????kild?? g??nd??rildi', 'state'=>'T??brikl??r!']);
        } 
    }	
	public function advertShow($id){
        // create visitor views
        Advert::find($id)->increment('advert_count');
        
		$config=Config::where('config_id', 1)->first();
		
		$advertDetail=Advert::where('advert_id', $id)->first();

        $getAllAdvertUser=Checks::where('advertID', $advertDetail->advert_id)->where('check_status', 'confirm')->get();
		
		return view('front.advert-detail', compact('config', 'advertDetail', 'getAllAdvertUser'));       
    }
    public function advertDelete($id){
        $newAdvert=Advert::where("advert_id", $id)->first();

        if($newAdvert->advert_images != ''){
            $all_images=json_decode($newAdvert->advert_images);
            for($m=0; $m < count($all_images); $m++ ){
                $image_path = public_path().'/front/img/adverts/'.$all_images[$m];                
                unlink($image_path);
            }      
            
            Advert::find($id)->delete();
            return redirect()->route('index');
        } else {
            Advert::find($id)->delete();
            return redirect()->route('index'); 
        }               
    }

    // forgot password page =======================================================================>
    public function forgotPassword(){
		if(session()->has('LoggedUser')){
			return redirect()->route('profile.dashboard');       
        }
		
        $config=Config::where('config_id', 1)->first();

        return view('front.forgot', compact('config'));       
    }
    public function forgotPasswordPost(Request $request){
		$request->validate([
            'email'=>'required|email',
        ]);

        $reset_code=Str::random(200);

        $checkUser=User::where('user_email', $request->email)->where('user_status', 'user')->first();

        if($checkUser){
            $checkEmail=PasswordReset::where('reset_email', $request->email)->first();

            if($checkEmail){
                $checkEmail->reset_code=$reset_code;
                $checkEmail->save();

                Mail::to($checkUser->user_email)->send(new ForgetPasswordMail($checkUser->user_email, $reset_code, $checkUser->user_name));

                return redirect()->route('password.forgot')->with('successForgot', 'T??brikl??r! Linkiniz ba??ar??l?? ????kild?? g??nd??rildi. Z??hm??t olmasa email addressiniz yoxlay??n');
            } else {
                $forgot=new PasswordReset; 
                $forgot->reset_email=$request->email;
                $forgot->reset_code=$reset_code;
                $forgot->save();

                Mail::to($checkUser->user_email)->send(new ForgetPasswordMail($checkUser->user_email, $reset_code, $checkUser->user_name));

                return redirect()->route('password.forgot')->with('successForgot', 'T??brikl??r! Linkiniz ba??ar??l?? ????kild?? g??nd??rildi. Z??hm??t olmasa email addressiniz yoxlay??n');
            }
        } else {
            return back()->with('failForgot', 'Bu hesab qeydiyyatdan ke??m??mi??dir. Yenid??n c??hd edin!');
        }
    }

    public function resetPassword($reset_code){
		$reset_code_data=PasswordReset::where('reset_code', $reset_code)->first();

        if(!$reset_code_data || Carbon::now()->subMinutes(10) > $reset_code_data->updated_at){
            return redirect()->route('password.forgot')->with('failForgot', 'Ooops! Linkiniz yaln????d??r v??ya vaxt?? bitib. Yenid??n c??hd edin!');
        } else {
            $config=Config::where('config_id', 1)->first();

            return view('front.reset', compact('config', 'reset_code')); 
        }
    }
    public function resetPasswordPost(Request $request, $reset_code){
		$request->validate([
            'password'=> 'required|min:5|max:13|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=> 'required|min:5|max:13'
        ]);

        if($request->password == $request->password_confirmation){
            $reset_code_check=PasswordReset::where('reset_code', $reset_code)->first();

            $checkUser=User::where('user_email', $reset_code_check->reset_email)->where('user_status', 'user')->first();
            $checkUser->user_password=Hash::make($request->password);
            $checkUser->save();

            $reset_code_check->delete();

            $request->session()->put('LoggedUser', $checkUser->user_id);
            return redirect()->route('profile.dashboard');
            
        } else {
            return back()->with('failReset', '??ifr?? do??rulanmas?? yaln????d??r. Yenid??n c??hd edin!');
        } 
    }
}
