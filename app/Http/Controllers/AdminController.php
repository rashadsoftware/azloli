<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Config;
use App\Models\Message;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Skills;
use App\Models\Data;
use App\Models\Banner;
use App\Models\Advert;

use Validator;
use Carbon\Carbon;

class AdminController extends Controller {
    public function __construct(){
        // $this->middleware('isLoggedIP');
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
            'companyEmail2'=>'required|email',
            'companyPhone'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'companyPhone2'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'companyPhone3'=>'required|regex:/^0[0-9]{9}/i|numeric',
            'companyAddress'=>'required|min:5|max:100',
            'companyShortDescription'=>'required|min:5|max:200',
            'companyDescription'=>'required|min:5|max:1000',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $config=Config::where('config_id', 1)->first(); 
            $config->config_title=$request->companyTitle;
            $config->config_email=$request->companyEmail;
            $config->config_email2=$request->companyEmail2;
            $config->config_phone=$request->companyPhone;
            $config->config_phone2=$request->companyPhone2;
            $config->config_phone3=$request->companyPhone3;
            $config->config_address=$request->companyAddress;
            $config->config_shortdescription=$request->companyShortDescription;
            $config->config_description=$request->companyDescription;

            if ($request->filled('companyVideoRolik')) {
                $validatorVideoRolik = Validator::make($request->all(),[
                    'companyVideoRolik'=>'url',
                ]);
    
                if(!$validatorVideoRolik->passes()){
                    return response()->json(['status'=>0, 'error'=>$validatorVideoRolik->errors()->toArray()]);
                }else{                
                    $config->config_video_rolik=$request->companyVideoRolik;
                }
            }

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
        $id=1;
        $config=Config::findOrFail($id); 

        if ($request->filled('companyFacebook')) {
            $validatorFacebook = Validator::make($request->all(),[
                'companyFacebook'=>'url',
            ]);

            if(!$validatorFacebook->passes()){
                return response()->json(['status'=>0, 'error'=>$validatorFacebook->errors()->toArray()]);
            }else{                
                $config->config_facebook=$request->companyFacebook;
            }
        }

        if ($request->filled('companyInstagram')) {
            $validatorInstagram = Validator::make($request->all(),[
                'companyInstagram'=>'url',
            ]);

            if(!$validatorInstagram->passes()){
                return response()->json(['status'=>0, 'error'=>$validatorInstagram->errors()->toArray()]);
            }else{
                $config->config_instagram=$request->companyInstagram;
            }
        }

        if ($request->filled('companyWhatsapp')) {
            $validatorWhatsapp = Validator::make($request->all(),[
                'companyWhatsapp'=>'url',
            ]);

            if(!$validatorWhatsapp->passes()){
                return response()->json(['status'=>0, 'error'=>$validatorWhatsapp->errors()->toArray()]);
            }else{
                $config->config_whatsapp=$request->companyWhatsapp;
            }
        }

        if ($request->filled('companyYoutube')) {
            $validatorYoutube = Validator::make($request->all(),[
                'companyYoutube'=>'url',
            ]);

            if(!$validatorYoutube->passes()){
                return response()->json(['status'=>0, 'error'=>$validatorYoutube->errors()->toArray()]);
            }else{
                $config->config_youtube=$request->companyYoutube;
            }
        }

        
        $config->save();        
    
        return response()->json(['status'=>1, 'msg'=>'Şirkət məlumatları başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
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
            'newpassword' => 'required|min:6|max:15|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:15',
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

    /* Advert page 
    ==================================================================> */
    public function advert(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $configs=Config::where('config_id', 1)->first();
        $adverts=Advert::all();

        return view('admin.advert', compact('user', 'configs', 'adverts'));
    }
	public function confirmAdvert($id){		
        $detail=Advert::where('advert_id', $id)->first();
        $detail->advert_status="active";
        $detail->save();

		toastr()->success('İş təklifi başarılı şəkildə təsdiqləndi', 'Təbriklər!');
        return redirect()->route('admin.advert'); 
    }
	public function cancelAdvert($id){		
        $detail=Advert::where('advert_id', $id)->first();
        $detail->advert_status="passive";
        $detail->save();

		toastr()->success('İş təklifi başarılı şəkildə deaktiv edildi', 'Təbriklər!');
        return redirect()->route('admin.advert'); 
    }
	public function readAdvert($id){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }        

        $configs=Config::where('config_id', 1)->first();
		
        $detail=Advert::where('advert_id', $id)->first();
        $detail->advert_read="read";
        $detail->save();

        return view('admin.read-advert', compact('user', 'configs', 'detail'));
    }
	public function deleteAdvert($id){
        $newAdvert=Advert::where("advert_id", $id)->first();

        if($newAdvert->advert_images != ''){
            $all_images=json_decode($newAdvert->advert_images);
            for($m=0; $m < count($all_images); $m++ ){
                $image_path = public_path().'/front/img/adverts/'.$all_images[$m];                
                unlink($image_path);
            } 

            Advert::find($id)->delete();
            toastr()->success('İş təklifi başarılı şəkildə silindi', 'Təbriklər!');
            return redirect()->route('admin.advert');
        } else {
            Advert::find($id)->delete();
            toastr()->success('İş təklifi başarılı şəkildə silindi', 'Təbriklər!');
            return redirect()->route('admin.advert');
        }
    }

    /* Users page 
    ==================================================================> */
    public function users(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $configs=Config::where('config_id', 1)->first();
        $userall=User::where('user_status','user')->get();

        return view('admin.users', compact('user', 'configs', 'userall'));
    }	
	public function toggleUser(Request $request){
        $user=User::findOrFail($request->getID);
        $user->user_state=$request->getStatus=="true" ? 'active' : 'passive';
        $user->save();
    }	
	public function userDelete($id)
    {
        User::find($id)->delete();
        toastr()->success('İstifadəçi başarılı şəkildə silindi', 'Təbriklər!');
        return redirect()->route('admin.users');          
    }
	
	/* category page 
    ==================================================================> */
    public function category(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }
        $categories=Category::all();   

        return view('admin.category', compact(['user', 'categories']));
    }
    public function toggleCategory(Request $request){
        $category=Category::findOrFail($request->getID);
        $category->category_state=$request->getStatus=="true" ? 'active' : 'passive';
        $category->save();
    }	
    public function categoryCreate(){        
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        return view('admin.category-add', compact('user'));
    }
    public function categoryInsert(Request $request){        
        $request->validate([
            'exampleCategory' => 'required|min:3|max:60',
            // 'exampleCategoryImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $isExistCategory=Category::where('category_seftitle', Str::slug($request->exampleCategory))->first();

        if($isExistCategory){
            toastr()->info($request->exampleCategory.' adında kateqoriya mövcuddur. Yenidən cəhd edin!', 'Ooops!'); 
            return redirect()->route('admin.category.create'); 
        } else {
            $category=new Category;
            $category->category_title=$request->exampleCategory;        
            $category->category_seftitle=Str::slug($request->exampleCategory);

            // $newName=Str::slug($request->exampleCategoryImage).'.'.$request->file('exampleCategoryImage')->getClientOriginalExtension();
            // $request->file('exampleCategoryImage')->move(public_path('front/img/categories'), $newName);   
            // $category->category_image=$newName;

            $category->category_image="";
            $category->save();

            toastr()->success('Kateqoriya başarılı şəkildə qeydə alındı', 'Təbriklər!');
            return redirect()->route('admin.category.create');
        }        
    }	
	public function categoryEdit($id)
    {
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }
        $category=Category::findOrFail($id);

        return view('admin.category-edit', compact('user', 'category'));
    }	
	public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'exampleCategory' => 'required|min:3|max:60'
        ]);

        $isExistCategory=Category::where('category_seftitle', Str::slug($request->exampleCategory))->first();

        if($isExistCategory){
            toastr()->info($request->exampleCategory.' adında kateqoriya mövcuddur. Yenidən cəhd edin!', 'Ooops!'); 
            return redirect()->route('admin.category'); 
        } else {
            $category=Category::findOrFail($id);
            $category->category_title=$request->exampleCategory;
            $category->category_seftitle=Str::slug($request->exampleCategory);

            /*
            if($request->has('exampleCategoryImage')){
                if($category->category_image != ''){
                    $image_path = public_path().'/front/img/categories/'.$category->category_image;                
                    unlink($image_path);
                }
        
                $newName=Str::slug($request->exampleCategoryImage).'.'.$request->file('exampleCategoryImage')->getClientOriginalExtension();
                $request->file('exampleCategoryImage')->move(public_path('front/img/categories'), $newName);   
                $category->category_image=$newName;
            }
            */

            $category->save();

            toastr()->success('Kateqoriya başarılı şəkildə yeniləndi', 'Təbriklər!');
            return redirect()->route('admin.category'); 
        }    
    }	
	public function categoryDelete($id)
    {
        $countSubCategory=SubCategory::where('categoryID', $id)->count();
        $fetchCategory=Category::where('category_id', $id)->first();
		
        $countSkilss=Skills::where('categoryID', $id)->count();

        if($countSubCategory > 0){
            toastr()->error('Bu kateqoriyaya məxsus alt kateqoriyalar silinən zaman silinmə baş tutacaqdır.', 'Ooops!');
            return redirect()->route('admin.category');
        } else {			
			if($countSkilss > 0){
				toastr()->error('Bu kateqoriya bacarıqlar bölməsində istifadə olunur. Silinmə belə olan halda mümkün deyil.', 'Ooops!');
				return redirect()->route('admin.category');
			} else {
                /*
				if($fetchCategory->category_image != ''){
					$image_path = public_path().'/front/img/categories/'.$fetchCategory->category_image;                
					unlink($image_path);
				}
                */

				Category::find($id)->delete();
				toastr()->success('Kateqoriya başarılı silindi', 'Təbriklər!');
				return redirect()->route('admin.category'); 
			}                     
        }  
    }
	
	/* subcategory page 
    ==================================================================> */
    public function subcategory(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', session('LoggedAdmin'))->first();            
        }
        $subcategories=SubCategory::all();   
        $categoriesCount=Category::count();   

        return view('admin.subcategory', compact('user', 'subcategories', 'categoriesCount'));
    }
    public function toggleSubCategory(Request $request){        
        $subcategory=SubCategory::findOrFail($request->getID);

        $categoryCheck=Category::where('category_id', $subcategory->categoryID)->first();

        if($categoryCheck->category_state == 'active'){
            $subcategory->subcategory_state=$request->getStatus=="true" ? 'active' : 'passive';
            $subcategory->save();

            if($request->getStatus=="false"){
                $skills=Skills::where('subcategoryID', $request->getID)->get();
                foreach($skills as $skill){
                    $skill->delete();
                }                
            }
        }
    }
    public function subcategoryCreate(){        
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }
        $categories=Category::all();
        $categoriesCount=Category::count(); 

        return view('admin.subcategory-add', compact('user', 'categories', 'categoriesCount'));
    }
    public function subcategoryInsert(Request $request){        
        $request->validate([
            'exampleCategory'   => 'required',
            'exampleSubCategory' => 'required|min:3|max:60',
        ]);

        $isExistSubCategory=SubCategory::where('subcategory_seftitle', Str::slug($request->exampleSubCategory))->where('categoryID', '=', $request->exampleCategory)->first();

        if($isExistSubCategory){
            toastr()->info($request->exampleSubCategory.' adında alt kateqoriya mövcuddur. Yenidən cəhd edin!', 'Ooops!'); 
            return redirect()->route('admin.subcategory.create'); 
        } else {
            $subcategory=new SubCategory;
            $subcategory->subcategory_title=$request->exampleSubCategory;        
            $subcategory->subcategory_seftitle=Str::slug($request->exampleSubCategory);
            $subcategory->categoryID=$request->exampleCategory;
            $subcategory->save();

            toastr()->success('Alt kateqoriya başarılı şəkildə qeydə alındı', 'Təbriklər!');
            return redirect()->route('admin.subcategory.create'); 
        }        
    }	
	public function subcategoryEdit($id){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }
        $subcategory=SubCategory::findOrFail($id);
        $categories=Category::all();  

        return view('admin.subcategory-edit', compact('user', 'subcategory', 'categories'));
    }	
	public function subcategoryUpdate(Request $request, $id){
        $request->validate([
            'exampleCategory' => 'required',
            'exampleSubCategory' => 'required|min:3|max:60'
        ]);

        $subcategory=SubCategory::findOrFail($id);

        $isExistSubCategory=SubCategory::where('subcategory_seftitle', Str::slug($request->exampleSubCategory))
                                 ->where('categoryID', '=', $request->exampleCategory)
                                 ->first();

        if($isExistSubCategory){
            toastr()->info($request->exampleSubCategory.' adında alt kateqoriya mövcuddur. Yenidən cəhd edin!', 'Ooops!'); 
            return redirect()->route('admin.subcategory'); 
        } else {
            $subcategory->subcategory_title=$request->exampleSubCategory;
            $subcategory->subcategory_seftitle=Str::slug($request->exampleSubCategory);
            $subcategory->categoryID=$request->exampleCategory;
            $subcategory->save();

            toastr()->success('Alt kateqoriya başarılı şəkildə yeniləndi', 'Təbriklər!');
            return redirect()->route('admin.subcategory'); 
        }    
    }
	public function subcategoryDelete($id){
		$countSkilss=Skills::where('subcategoryID', $id)->count();
		
		if($countSkilss > 0){
			toastr()->error('Bu alt kateqoriya bacarıqlar bölməsində istifadə olunur. Silinmə belə olan halda mümkün deyil.', 'Ooops!');
			return redirect()->route('admin.subcategory');
		} else {
			SubCategory::find($id)->delete();
			toastr()->success('Alt kateqoriya başarılı şəkildə silindi', 'Təbriklər!');
			return redirect()->route('admin.subcategory'); 
		}
    }

    /* about page 
    ==================================================================> */
    public function about(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $dataOffers=Data::where('data_cat', 'offer')->get();

        return view('admin.about', compact('user', 'dataOffers'));
    }
    public function aboutUpdate(Request $request){
        $request->validate([
            'cat_title' => 'required',
            'cat_desc' => 'required|min:3|max:600'
        ]);

        $dataCheck=Data::where('data_key', $request->cat_title)->first();

        if($dataCheck){
            $dataCheck->data_value=$request->cat_desc;
            $dataCheck->save();

            toastr()->success('Missiya başarılı şəkildə yeniləndi', 'Təbriklər!');
            return redirect()->route('admin.pages.about');  
        } else {
            toastr()->error('Belə bir missiya mövcud deyil', 'Ooops!');
            return redirect()->route('admin.pages.about');  
        }  
    }
    public function offerPost(Request $request){
        $request->validate([
            'exampleOffer' => 'required|min:3|max:600'
        ]);

        $data=new Data;
        $data->data_key='offer';
        $data->data_value=$request->exampleOffer;
        $data->data_cat='offer';
        $data->save();

        toastr()->success('Təklif başarılı şəkildə yaradıldı', 'Təbriklər!');
        return redirect()->route('admin.pages.about');
    }
    public function offerEdit($id){
		if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $dataOffer=Data::where('data_id', $id)->where('data_cat', 'offer')->first();

        return view('admin.offer-edit', compact('user', 'dataOffer'));
    }
    public function offerUpdatePost(Request $request){
        $request->validate([
            'exampleOffer' => 'required|min:3|max:600'
        ]);

        $data=Data::where('data_id', $request->hiddenID)->where('data_cat', 'offer')->first();
        $data->data_value=$request->exampleOffer;
        $data->save();

        toastr()->success('Təklif başarılı şəkildə yeniləndi', 'Təbriklər!');
        return redirect()->route('admin.pages.about');
    }
    public function offerDelete($id){
		Data::find($id)->delete();
        
        return redirect()->route('admin.pages.about'); 
    }
    public function missionImage(Request $request){ 
        $validator = Validator::make($request->all(),[
            'imageMission' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $config=Data::where('data_key', 'mission')->where('data_cat', 'image')->first();
            
            if($config->data_value != ''){
                $image_path = public_path().'/front/img/about/'.$config->data_value;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->imageMission).'.'.$request->file('imageMission')->getClientOriginalExtension();
            $request->file('imageMission')->move(public_path('front/img/about'), $newName);   
            $config->data_value=$newName;  
            $config->save(); 

            return response()->json(['status'=>1, 'msg'=>'Missiya şəkli başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }
    public function offerImage(Request $request){
        $validator = Validator::make($request->all(),[
            'imageOffer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $config=Data::where('data_key', 'offer')->where('data_cat', 'image')->first();
            
            if($config->data_value != ''){
                $image_path = public_path().'/front/img/about/'.$config->data_value;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->imageOffer).'.'.$request->file('imageOffer')->getClientOriginalExtension();
            $request->file('imageOffer')->move(public_path('front/img/about'), $newName);   
            $config->data_value=$newName;  
            $config->save(); 

            return response()->json(['status'=>1, 'msg'=>'Təklif şəkli başarılı şəkildə yeniləndi', 'state'=>'Təbriklər!']);
        }
    }

    /* banner page 
    ==================================================================> */
    public function banner(){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $dataBanners=Banner::all();

        return view('admin.banner', compact('user', 'dataBanners'));
    }
    public function bannerPost(Request $request){
        $request->validate([
            'exampleBannerTitle' => 'required|min:3|max:1000',
            'exampleBannerSubTitle' => 'required|min:3|max:1000',
            'examplePosition' => 'required',
            'exampleBannerImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $newName=Str::slug($request->exampleBannerImage).'.'.$request->file('exampleBannerImage')->getClientOriginalExtension();
        $request->file('exampleBannerImage')->move(public_path('front/img/banner'), $newName); 

        $newBanner=new Banner;
        $newBanner->banner_title=$request->exampleBannerTitle;
        $newBanner->banner_subtitle=$request->exampleBannerSubTitle;
        $newBanner->banner_image=$newName;
        $newBanner->banner_position=$request->examplePosition;
        $newBanner->save();

        toastr()->success('Banner başarılı şəkildə yaradıldı', 'Təbriklər!');
        return redirect()->route('admin.pages.banner');          
    }
    public function bannerUpdate($id){
        if(session()->has('LoggedAdmin')){
            $user=User::where('user_id', '=', session('LoggedAdmin'))->first();            
        }

        $dataBanners=Banner::where("banner_id", $id)->first();

        return view('admin.banner-edit', compact('user', 'dataBanners'));
    }
    public function bannerUpdatePost(Request $request, $id){
        $request->validate([
            'exampleBannerTitle' => 'required|min:3|max:1000',
            'exampleBannerSubTitle' => 'required|min:3|max:1000',
            'examplePosition' => 'required',
        ]);

        $newBanner=Banner::where("banner_id", $id)->first();
        $newBanner->banner_title=$request->exampleBannerTitle;
        $newBanner->banner_subtitle=$request->exampleBannerSubTitle;
        $newBanner->banner_position=$request->examplePosition;
        

        if($request->has('exampleBannerImage')){
            if($newBanner->banner_image != ''){
                $image_path = public_path().'/front/img/banner/'.$newBanner->banner_image;                
                unlink($image_path);
            }
    
            $newName=Str::slug($request->exampleBannerImage).'.'.$request->file('exampleBannerImage')->getClientOriginalExtension();
            $request->file('exampleBannerImage')->move(public_path('front/img/banner'), $newName); 
            $newBanner->banner_image=$newName;
        }

        $newBanner->save();

        toastr()->success('Banner başarılı şəkildə yeniləndi', 'Təbriklər!');
        return redirect()->route('admin.pages.banner');          
    }
    public function bannerDelete($id){
        $dataBanner=Banner::where('banner_id', $id)->first();
            
        $image_path = public_path().'/front/img/banner/'.$dataBanner->banner_image;                
        unlink($image_path);

        Banner::find($id)->delete();
        toastr()->success('Banner başarılı şəkildə silindi', 'Təbriklər!');
        return redirect()->route('admin.pages.banner');     
    }
}
