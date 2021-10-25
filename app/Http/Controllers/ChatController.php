<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Owner;
use App\Models\User;
use App\Models\Merge;
use App\Models\Chat;

use DB;

use Validator;

class ChatController extends Controller
{	
    /* index page 
    ==================================================================> */
    public function index(){
		if(session()->has('LoggedOwner')){
			return redirect()->route('chat.users');
		} else {
			if(session()->has('LoggedUser')){
				return redirect()->route('chat.login');
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
				
				$requiredOwner=Owner::where('owner_email', $request->email)->first();
				
				if($requiredOwner){
					$requiredOwner->owner_online='online';
					$requiredOwner->save();
						
					$request->session()->put('LoggedOwner', $requiredOwner->user_id);
					return response()->json(['status'=>2]);
				} else {
					return response()->json(['status'=>1, 'msg'=>'Bu hesaba bağlı bir email addressi yoxdur. Yenidən cəhd edin!']);
				}                
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
                $id=session('LoggedUser');       
                $checkID=User::where('user_id', $id)->first();

                if($checkID->user_email == $request->email){
                    $checkUser=User::where('user_email', $request->email)->first();

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
                    return response()->json(['status'=>1, 'msg'=>'Xəta yarandı. Yenidən cəhd edin!']);
                }
            } else {
                $checkOwner=Owner::where('owner_email', $request->email)->first();

                if($checkOwner){
                    if(Hash::check($request->password, $checkOwner->owner_password)){
						$checkOwner->owner_online='online';
						$checkOwner->save();
						
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
	
	/* logout page 
    ==================================================================> */
    public function logout(){
		if(session()->has('LoggedOwner')){
			if(!session()->has('LoggedUser')){
				$checkOwner=Owner::where('owner_id', session('LoggedOwner'))->first();
				$checkOwner->owner_online='offline';
				$checkOwner->save();
			}
			
			session()->pull('LoggedOwner');
            return redirect()->route('chat.login');
		} else {
			return redirect()->route('chat.login');
		}
    }
	
	/* users page 
    ==================================================================> */    
    public function usersCreate($id){
		$userSession=session()->put('userSession', $id);

        return redirect()->route('chat.index');
    }
    public function users(){
		if(session()->has('LoggedOwner')){			  
			
			if(session()->has('LoggedUser')){	
				$idUser=session('LoggedUser'); 							
				$user=User::where('user_id', $idUser)->first();

                //$users=Merge::where('merge_user', $idUser)->get();
                //$usersCount=Merge::where('merge_user', $idUser)->count();
			} else {
				$id=session('LoggedOwner'); 
				$user=Owner::where('owner_id', $id)->first();

                $userID=session('userSession');                

                $checkMerge=Merge::where('merge_user', $userID)->where('merge_owner', $id)->first();

                if(!$checkMerge){
                    $merge=new Merge;
                    $merge->merge_user=$userID;
                    $merge->merge_owner=$id;
                    $merge->save();
                }

                //$users=Merge::where('merge_owner', $id)->get();
                //$usersCount=Merge::where('merge_owner', $id)->count();
			}
			
			//return view('chat.users', compact('user', 'users', 'usersCount')); 
			return view('chat.users', compact('user')); 
		} else {
			return redirect()->route('chat.login');
		}
    }
	function action(Request $request) {
     	if($request->ajax()) {
      		$output = '';
      		$query = $request->get('query');			

			if(session()->has('LoggedUser')){
				if($query != '') {
					$dataUser=Merge::where('merge_user', session('LoggedUser'))->get();
					foreach ($dataUser as $userItem) {
						$data=Owner::where('owner_id', $userItem->merge_owner)->where('owner_username', 'like', '%'.$query.'%')->get();

						foreach($data as $row) {
							$output .= '
								<a href="'.route('chat.chat', $row->owner_id).'">
									<div class="content">';
					$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->owner_username.'"> ';
			$output .= '				<div class="details">
											<span>'.$row->owner_username.'</span>
										</div>
									</div>';
									if($row->owner_online == "online"){
					$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
									} else { 
					$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
									}
				$output .= '	</a>						
							';
						}						
					}
				} else {
					$data=Merge::where('merge_user', session('LoggedUser'))->get();

					foreach($data as $row) {
						$output .= '
								<a href="'.route('chat.chat', $row->getOwnerMerge->owner_id).'">
									<div class="content">';
					$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->getOwnerMerge->owner_username.'"> ';
			$output .= '				<div class="details">
											<span>'.$row->getOwnerMerge->owner_username.'</span>
										</div>
									</div>';
									if($row->getOwnerMerge->owner_online == "online"){
					$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
									} else { 
					$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
									}
				$output .= '	</a>						
							';
					}
				}
			} else {
				
				if($query != '') {
					$dataUser=Merge::where('merge_owner', session('LoggedOwner'))->get();
					foreach ($dataUser as $userItem) {
						$data=User::where('user_id', $userItem->merge_user)->where('user_name', 'like', '%'.$query.'%')->get();

						foreach($data as $row) {
							$output .= '
									<a href="'.route('chat.chat', $row->user_id).'">
										<div class="content">';
											if($row->user_image == ''){
							$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->user_name.'"> ';
											} else {
							$output .= '		<img src="'.asset('front/').'/img/user/'.$row->user_image.'" alt="'.$row->user_name.'">';
											}
							$output .= '	<div class="details">
												<span>'.$row->user_name.'</span>
											</div>
										</div>';
										if($row->user_online == "online"){
						$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
										} else { 
						$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
										}
					$output .= '	</a>						
								';
						}						
					}	
				} else {					
					$data=Merge::where('merge_owner', session('LoggedOwner'))->get();

					foreach($data as $row) {
						$output .= '
								<a href="'.route('chat.chat', $row->getUserMerge->user_id).'">
									<div class="content">';
										if($row->getUserMerge->user_image == ''){
						$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->getUserMerge->user_name.'"> ';
										} else {
						$output .= '		<img src="'.asset('front/').'/img/user/'.$row->getUserMerge->user_image.'" alt="'.$row->getUserMerge->user_name.'">';
										}
			$output .= '				<div class="details">
											<span>'.$row->getUserMerge->user_name.'</span>
										</div>
									</div>';
									if($row->getUserMerge->user_online == "online"){
					$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
									} else { 
					$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
									}
				$output .= '	</a>						
							';
					}
				}
			}

			$data = array(
				'table_data'  => $output,
			);

      		echo json_encode($data);
     	}
    }

	public function updateList(){
		$output='';

		if(session()->has('LoggedUser')){
			$dataUser=Merge::where('merge_user', session('LoggedUser'))->get();
			foreach ($dataUser as $userItem) {
				$data=Owner::where('owner_id', $userItem->merge_owner)->get();

				foreach($data as $row) {
					$output .= '
						<a href="'.route('chat.chat', $row->owner_id).'">
							<div class="content">';
			$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->owner_username.'"> ';
	$output .= '				<div class="details">
									<span>'.$row->owner_username.'</span>
								</div>
							</div>';
							if($row->owner_online == "online"){
			$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
							} else { 
			$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
							}
		$output .= '	</a>						
					';
				}						
			}
		} else {
			$dataUser=Merge::where('merge_owner', session('LoggedOwner'))->get();
			foreach ($dataUser as $userItem) {
				$data=User::where('user_id', $userItem->merge_user)->get();

				foreach($data as $row) {
					$output .= '
							<a href="'.route('chat.chat', $row->user_id).'">
								<div class="content">';
									if($row->user_image == ''){
					$output .= '		<img src="'.asset('front/').'/img/icons/profile.svg" alt="'.$row->user_name.'"> ';
									} else {
					$output .= '		<img src="'.asset('front/').'/img/user/'.$row->user_image.'" alt="'.$row->user_name.'">';
									}
					$output .= '	<div class="details">
										<span>'.$row->user_name.'</span>
									</div>
								</div>';
								if($row->user_online == "online"){
				$output .= '		<div class="status-dot online"><i class="fas fa-circle"></i></div>';
								} else { 
				$output .= '		<div class="status-dot offline"><i class="fas fa-circle"></i></div>';
								}
			$output .= '	</a>						
						';
				}						
			}	
		}

		echo $output;
    }
	
	/* chat page 
    ==================================================================> */
    public function chat($id){
		if(session()->has('LoggedOwner')){
			if(session()->has('LoggedUser')){
				$user=Merge::where('merge_user', session('LoggedOwner'))->where('merge_owner', $id)->first();
				$userCount=Merge::where('merge_user', session('LoggedOwner'))->where('merge_owner', $id)->count();
                
                $sends=Chat::where('message_user', session('LoggedOwner'))->where('message_owner', $id)->get();
				$sendsCount=Chat::where('message_user', session('LoggedOwner'))->where('message_owner', $id)->count();

                $inboxs=Chat::where('message_user', session('LoggedOwner'))->where('message_owner', $id)->get();
				$inboxsCount=Chat::where('message_user', $id)->where('message_owner', session('LoggedOwner'))->count();
			} else {
				$user=Merge::where('merge_user', $id)->where('merge_owner', session('LoggedOwner'))->first();
				$userCount=Merge::where('merge_user', $id)->where('merge_owner', session('LoggedOwner'))->count();

                $sends=Chat::where('message_user', $id)->where('message_owner', session('LoggedOwner'))->get();
				$sendsCount=Chat::where('message_user', $id)->where('message_owner', session('LoggedOwner'))->count();

                $inboxs=Chat::where('message_user', session('LoggedOwner'))->where('message_owner', $id)->get();
				$inboxsCount=Chat::where('message_user', $id)->where('message_owner', session('LoggedOwner'))->count();
			}
			
			if($userCount > 0){
				return view('chat.chat', compact('user', 'sends', 'sendsCount', 'inboxs', 'inboxsCount'));
			} else {
				return redirect()->route('chat.users');
			}			
			
		} else {
			return redirect()->route('chat.login');
		}         
    }
	public function insertChat(Request $request){
		if(session()->has('LoggedOwner')){	
			$incoming_id = $request->incoming_id;
			$text = $request->message;
			
			if(session()->has('LoggedUser')){
				$id=session('LoggedUser');
				if($text != ""){
					$message=new Chat;
					$message->message_owner=$id;
					$message->message_user=$incoming_id;
					$message->message_text=$text;
					$message->message_read="unread";
					$message->save();
				}
			} else {
				$id=session('LoggedOwner');
				if($text != ""){
					$message=new Chat;
					$message->message_owner=$id;
					$message->message_user=$incoming_id;
					$message->message_text=$text;
					$message->message_read="unread";
					$message->save();                    
				}
				return response()->json(['status'=>'ok']);
			}			
		} else {
			return redirect()->route('chat.login');
		}
    }
	public function getChat(Request $request){
		if(session()->has('LoggedOwner')){
			$incoming_id = $request->incoming_id; // inputdan gelen			
			
			$output = "";

			if(session()->has('LoggedUser')){
				$outgoing_id=session('LoggedUser');

				$query=DB::table('messages')
				->leftJoin('owners', 'owners.owner_id', '=', 'messages.message_owner')
				->where([
				 'messages.message_user' => $outgoing_id,
				 'messages.message_owner' => $incoming_id,
				])
				->orWhere([
				 'messages.message_user' => $incoming_id,
				 'messages.message_owner' => $outgoing_id,
				])
				->orderBy('messages.message_id')
				->get();

				if($query->count() > 0){
					foreach ($query as $row) {
						if($row->message_owner == $outgoing_id){
							$output .= '<div class="chat outgoing">
											<div class="details">
												<p>'. $row->message_text .'</p>
											</div>
										</div>';
						} else {
							$output .= '<div class="chat incoming">';
						$output .= '		<div class="details">
												<p>'. $row->message_text .'</p>
											</div>
										</div>';
						}
					}		
				} else {
					$output .= '<div class="text">Mesaj yoxdur. Mesaj göndərildikdən sonra hamısı burada görünəcək.</div>';
				}
			} else {
				$outgoing_id=session('LoggedOwner');

				$query=DB::table('messages')
				->leftJoin('users', 'users.user_id', '=', 'messages.message_user')
				->where([
				 'messages.message_user' => $outgoing_id,
				 'messages.message_owner' => $incoming_id,
				])
				->orWhere([
				 'messages.message_user' => $incoming_id,
				 'messages.message_owner' => $outgoing_id,
				])
				->orderBy('messages.message_id')
				->get();

				if($query->count() > 0){
					foreach ($query as $row) {
						if($row->message_owner == $outgoing_id){
							$output .= '<div class="chat outgoing">
											<div class="details">
												<p>'. $row->message_text .'</p>
											</div>
										</div>';
						} else {
							$output .= '<div class="chat incoming">';
						$output .= '		<div class="details">
												<p>'. $row->message_text .'</p>
											</div>
										</div>';
						}
					}		
				} else {
					$output .= '<div class="text">Mesaj yoxdur. Mesaj göndərildikdən sonra hamısı burada görünəcək.</div>';
				}

			}		
			
			echo $output;
		} else {
			return redirect()->route('chat.login');
		}
    }
}
