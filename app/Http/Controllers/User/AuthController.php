<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash, Session, Mail;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('post')){
            $data=$request->except('_token');
            $userdata=['email'=>$data['email'],'password'=>$data['password'],'deleted_at'=>null];
            if(Auth::guard('web')->attempt($userdata)){
                return redirect('user/home')->with('success','User Login successfully');
           }else{
                return redirect()->back()->with('error',"Invalid email and password combination");
                }
        }
        
   	    return view('User.login');
    }



    public function dashboard(){
    	return view('User.index');
    }

    public function logout(){
  
    	Auth::guard('web')->logout();
    	Session::flush();
    	return redirect('user/login')->with('success','user logged out successfully');
    }


    public function forgot_password(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();

			$email = $data['email'];
			$user = User::where('email',$email)->first();
			$project_name = 'New Project';
			if(empty($user)){
				return redirect()->back()->with('error','Invalid email-id');
			} else{
				$user_id 	= base64_encode($user->id);
				$user_name 	= ucfirst($user->first_name);
				$random_no 	= rand(111111, 999999);
	            $code 		= $random_no.time();
	            $security_code = base64_encode(convert_uuencode($code));

	            $user->security_code = $security_code;
	            $user->save();

				$set_password_url = url('/user/set-password/'.$security_code.'/'.$user_id);
				// dd($set_password_url);
				try{
					// dd($email);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {   
                        Mail::send('emails.user_forgot_password',['name'=>$user_name,'email'=>$email,'set_password_url'=>$set_password_url],function($message) use($email,$project_name){
                            $message->to($email,$project_name)->subject('Forgot password');
                        });
                    }
                }catch(Exception $e){
                }
                return redirect('user/login')->with('success','Email sent successfully,on registered email.');
				
			}
		}
		return view('User.forgotPassword');
	}

	public function set_password(Request $request, $security_code, $user_id){
	
		if(!Auth::User()){
			$user_id = base64_decode($user_id);
			$user = User::where(['id'=>$user_id,'security_code'=>$security_code])->first();
			
			if(!empty($user->security_code)){
				$email = $user->email;
				if($request->isMethod('post')){
					$data = $request->all();
					// dd($data);
					if(!empty($data['new_pw']) && !empty($data['confirm_pw'])){
						if($data['new_pw'] == $data['confirm_pw']){
							$hash_password = Hash::make($data['new_pw']);
							$password      = str_replace("$2y$","$2a$",$hash_password);
							$user->security_code = null;
							$user->password = $password;
							if($user->save()){
								return redirect('/user/login')->with('success','Password changed successfully');	
							} else{
								return redirect()->back()->with('error','Something went wrong,Please try again later.');	
							}

						} else{
							return redirect()->back()->with('error',"Password and confirm password doesn't matched");	
						}
					} else{
						return redirect()->back()->with('error','Please enter password to change');
					}
				}
				return view('User.changePassword', compact('email'));
			} else{
				return redirect('/user/login')->with('error','Link expired');
			}
		} else{
			return redirect('user/home')->with('error','Please logout your profile');
		}
	}

	public function reset_password(Request $request){
		
		$user_id = 	Auth::guard('web')->user()->id;
        $user    = 	User::where('id',$user_id)->first();

    	if($request->isMethod('post')){
    		$data = $request->all();
			if($data['new_password'] != $data['confirm_password']){
				return redirect()->back()->with('error',"Password and confirm password doesn't matched");
			}
			$credentials = array(
						'email'=>$user->email,
						'password'=>$data['old_password']
					);
			if(Auth::guard('web')->attempt($credentials)){

				$user->password = Hash::make($data['new_password']);
				if($user->save()){
					return redirect()->back()->with('success',"Password changed successfully");		
				} else{
					return redirect()->back()->with('error',COMMON_ERROR);		
				}

			} else{
				return redirect()->back()->with('error',"Incorrect current password");	
			}
    	}
		$label = 'Reset Password'; 
		return view('User.Profile.resetPassword', compact('label'));
	}

	public function my_profile(Request $request){
		
		$user_id 	= 	Auth::guard('web')->user()->id;
        $profile    = 	User::where('id',$user_id)->first();

		if($request->isMethod('post')){
			$data 				= $request->all();
			$profile->name 		= $data['name']; 
			$profile->user_name = $data['user_name']; 
			$profile->gender 	= $data['gender']; 
			$profile->email 	= $data['email']; 
			// $profile->dob 		= $data['dob']; 
			// $profile->height 	= $data['height']; 
			// $profile->weight 	= $data['weight']; 
			$profile->phone 	= $data['phone']; 
			if(!empty($data['profile_image'])){
				if(!empty($_FILES['profile_image']['name'])){
	    			$info = pathinfo($_FILES['profile_image']['name']);
	    			$extension = $info['extension'];
	    			$random = rand(0000000,9999999);
	    			$new_name = $random.'.'.$extension;

	    			if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
	    				$file_path = base_path().'/'.AdminProfileBasePath;
	    				move_uploaded_file($_FILES['profile_image']['tmp_name'], $file_path.'/'.$new_name);

	    				$profile->profile_image = $new_name;
	    			}
	    		}
			}
    		if($profile->save()){
					return redirect()->back()->with('success',"Profile Updated successfully");		
				} else{
					return redirect()->back()->with('error','Something went wrong, Please try again later.');		
				}
		}
		
		$label = 'My Porfile'; 
		return view('User.Profile.profile', compact('label','profile'));	
	}
}
