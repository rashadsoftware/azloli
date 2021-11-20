<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;
use App\Models\Advert;
use App\Models\Jobs;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Skills;
use App\Models\Checks;

use Validator;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('isLoggedProfile');
        $this->middleware('isActiveProfile');
    }
    
    // index page =======================================================================>
    public function index(){
        $id=session('LoggedUser');

        $user=User::where('user_id', $id)->first();

        if($user->user_ip == ''){
            $ip=\Request::ip();
            $user->user_ip=$ip;
        } 
        
        $user->user_online='online';
        $user->save(); 
        
        $config=Config::where('config_id', 1)->first();

        $skillsCount=Skills::where('userID', $id)->count();
		$skills=Skills::where('userID', $id)->get();

        $images=Jobs::where('userID', $id)->get();
        $imagesCount=Jobs::where('userID', $id)->count();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
        return view('profile.index', compact('user', 'config', 'skillsCount', 'skills', 'images', 'imagesCount'));       
    }
    public function publish(){
        $id=session('LoggedUser');

        $userData=User::where('user_id', $id)->first();

        if($userData->user_address != '' && $userData->user_phone != '' && $userData->user_description != ''){
            $userSkill=Skills::where('userID', $id)->count();

            if($userSkill > 0){
                $user=User::where('user_id', $id)->first();
                $user->user_publish='publish';
                $user->user_online='online';
                $user->save(); 
                
                return redirect()->route('profile.dashboard')->with('successDashboard', 'Təbriklər! Yayımı başlatdınız. Bu andan etibarən bütün istifadəçilər sizi görə və sizə iş təklifi edə bilərlər. Zəhmət olmasa mütəmadi olaraq hesablarınızı kontrol edin.');
            } else {
                return redirect()->route('profile.skills')->with('alertDashboard', 'Siz hesabınızı aktivləşdirmək üçün bu səhifədə  özünüz haqqında məlumatlarınızı tam şəkildə doldurmalısınız!');
            }

        } else {
            return redirect()->route('profile.settings')->with('alertDashboard', 'Siz hesabınızı aktivləşdirmək üçün bu səhifədə  özünüz haqqında məlumatlarınızı tam şəkildə doldurmalısınız!');
        }
    }
	public function unpublish(){
        $id=session('LoggedUser');
		
		$user=User::where('user_id', $id)->first();
		$user->user_publish='unpublish';
        $user->user_online='offline';
		$user->save(); 
		
		return redirect()->route('profile.dashboard')->with('alertDashboard', 'Yayımınız dayandırıldı. Bu andan etibarən heç bir profildə görsənməyəcək və heç kəsdən iş təklifi almayacaqsınız.');
    }
	
	// jobs page =======================================================================>
    public function jobs(){
        $config=Config::where('config_id', 1)->first();
        $id=session('LoggedUser');		

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();      
            
            $jobsCount=Jobs::where('userID', $id)->count();
		    $jobs=Jobs::where('userID', $id)->get();
        }
		
        return view('profile.jobs', compact('user', 'config', 'jobsCount', 'jobs'));
    }
	public function jobsAdd(Request $request){
		$id=session('LoggedUser'); 

        $request->validate([
            'job_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $jobs=new Jobs;         
    
        $newName=Str::slug($request->job_image).'.'.$request->file('job_image')->getClientOriginalExtension();
        $request->file('job_image')->move(public_path('front/img/jobs'), $newName);
        
        $jobs->userID=$id;  
        $jobs->job_image=$newName;  
        $jobs->save();
        
        return redirect()->route('profile.jobs')->with('successJobs', 'Təbriklər! Başarılı şəkildə referans şəkilini əlavə etdiniz.');
    }
	public function jobsDelete($id){
		$image=Jobs::where('job_id', $id)->first();
		
        $image_path = public_path().'/front/img/jobs/'.$image->job_image;                
        unlink($image_path);
		
		Jobs::find($id)->delete();
        return redirect()->route('profile.jobs')->with('successJobs', 'Təbriklər! Başarılı şəkildə referans şəkilinizi sildiniz.'); 
    }
	
	// skills page =======================================================================>
    public function skills(){
        $id=session('LoggedUser'); 
        $config=Config::where('config_id', 1)->first();
		
		$skillsCount=Skills::where('userID', $id)->count();
		$skills=Skills::where('userID', $id)->get();
		$subcategories=SubCategory::where('subcategory_state', 'active')->get();
        $categories=Category::where('category_state', 'active')->get();

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', session('LoggedUser'))->first();            
        }
		
        return view('profile.skills', compact('user', 'config', 'skillsCount', 'skills', 'subcategories', 'categories'));
    }
    public function skillsFetch(Request $request){
        
        $districtsCount=SubCategory::where('categoryID', '=', $request->cateID)->count();
        $districtsFetch=SubCategory::where('categoryID', '=', $request->cateID)->pluck('subcategory_title', 'subcategory_id');
        
        if($districtsCount > 0){
            return response(['status'=>'success', 'content'=>$districtsFetch]);
        } else {
            return response(['status'=>'error', 'content'=>'Bacarıq seçin']);
        }        
    }
	public function skillsAdd(Request $request){
		$id=session('LoggedUser');

        $request->validate([
            'selectCategory'=>'required',
            'selectSkills'=>'required',
        ]);
		
		$checkSkills=Skills::where('subcategoryID', $request->selectSkills)->where('userID', $id)->first();
		
		$categorySkills=SubCategory::where('subcategory_id', $request->selectSkills)->first();
		
		if($checkSkills){
			return back()->with('errorSkills', 'Bu bacarıq artıq qeydə alınıb');
		} else {
			$skills=new Skills;		
			$skills->userID=$id;    
			$skills->categoryID=$categorySkills->categoryID;  
			$skills->subcategoryID=$request->selectSkills;  
			$skills->save();
			
			return redirect()->route('profile.skills')->with('successSkills', 'Təbriklər! Başarılı şəkildə bacarıq əlavə edildi.');
		}
    }
	public function skillsDelete($id){		
		Skills::find($id)->delete();
        return redirect()->route('profile.skills')->with('successSkills', 'Təbriklər! Başarılı şəkildə qeyd olunan bacarığı sildiniz.'); 
    }
	
	// advert page =======================================================================>
    public function advert(){		
        $config=Config::where('config_id', 1)->first();
        $id=session('LoggedUser');		

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', $id)->first();
        }
		
		$unreadChecks=Checks::where('userID', $id)->where('check_read', 'unread')->get();
		$readChecks=Checks::where('userID', $id)->where('check_read', 'read')->get();
		$allChecks=Checks::where('userID', $id)->get();
		
        return view('profile.advert', compact('user', 'config', 'readChecks', 'unreadChecks', 'allChecks'));
    }
	public function advertDetail($advertID){ 
        $config=Config::where('config_id', 1)->first();
        $idUser=session('LoggedUser');

        if(session()->has('LoggedUser')){
            $user=User::where('user_id', $idUser)->first();
        }
		
        if($user->user_publish == "publish"){
            $check=Checks::where('advertID', $advertID)->where('userID', $idUser)->first();
            $check->check_read='read';
            $check->save();
            
            $getAdvert=Advert::where('advert_id', $advertID)->first();
            
            return view('profile.advert-detail', compact('user', 'config', 'getAdvert', 'idUser'));
        } else {
            return redirect()->route('profile.advert')->with('alertDashboard', 'Ooops! Bu bölməyə gedə bilmək üçün siz profilinizi aktivləşdirməlisiniz'); 
        }
		
    }
	public function advertConfirm($advertID){
		$idUser=session('LoggedUser');
		
		$check=Checks::where('advertID', $advertID)->where('userID', $idUser)->first();
		$check->check_status='confirm';
		$check->save();
		
		return redirect()->route('profile.advert')->with('successDashboard', 'Təbriklər! Başarılı şəkildə gələn təklifi təsdiqləmiş oldunuz'); 
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
            'userPhone'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'exampleAddress' => 'required|min:3|max:3000',
            'exampleTextArea' => 'required|min:3|max:3000',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $user=User::where('user_id', $id)->first();
            $user->user_name=$request->exampleUser;
            $user->user_email=$request->exampleEmail;
            $user->user_phone=$request->userPhone;
            $user->user_address=$request->exampleAddress;
            $user->user_description=$request->exampleTextArea;
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
            'newpassword' => 'required|min:6|max:15|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:15',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else{
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
            $id=session('LoggedUser');

            $user=User::where('user_id', $id)->first();
            $user->user_online='offline';
            $user->save(); 

            session()->pull('LoggedUser');
            return redirect()->route('login');
        }
    }
}
