<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use IlluminateHttpRequest;
use AppHttpRequestsRegisterAuthRequest;
// use TymonJWTAuthExceptionsJWTException;
use SymfonyComponentHttpFoundationResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Admin;
use Mail, Hash, Auth;

class ApiController extends Controller
{
    public function user_registration(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'user_name' => 'required|unique:users,user_name,Null,id,deleted_at,NULL',
                'phone' => 'required|numeric',
                'email' => 'required|email|unique:users,email,Null,id,deleted_at,NULL',
                'gender' => 'required',
                'dob' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'disability' => 'required',
                'login_type' => 'required',
                'password'=>'required',
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->user_name = $data['user_name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->dob = $data['dob'];
        $user->height = $data['height'];
        $user->weight = $data['weight'];
        $user->disability = $data['disability'];
        $user->login_type = $data['login_type'];
        if (@$data['password']) {
            $hash_password  = Hash::make($data['password']);
            $user->password = str_replace("$2y$", "$2a$", $hash_password);
        }
        $user->status             = 'Active';
        if ($user->save()) {
            return response()->json(['message' => 'User register Successfuly', 'data' => $user, 'code' => 200]);
        } else {
            return response()->json(['message' => 'Something went wrong', 'code' => 400]);
        }
    }

    public function user_login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_name'      => 'required',
                'password'   => 'required'
            ]
        );
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }
        $credentials = $request->only('user_name', 'password');
        try{
            $token = auth()->attempt($credentials);
           
            if ($token) {
                $user = auth()->userOrFail();
                return response()->json(['message' => 'User login Successfuly', 'token' => $token, 'data' => $user, 'code' => 200]);
            } else {
                return response()->json(['message' => 'Invalid Username or Password', 'code' => 400]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = auth()->userOrFail();
            $user['profile_pic'] = @$user->profile_pic ? env('APP_URL') . 'uploads/' . $user->profile_image : 'http://www.pngall.com/wp-content/uploads/5/Profile-Male-PNG-180x180.png';
            return response()->json(['message' => 'User Profile', 'data' => $user, 'code' => 200]);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['message' => 'Something went wrong, Please try again later.', 'code' => 400]);
        }
    }


    public function forgot_password(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'      => 'required|email',
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }


        $check_email_exists = User::where('email', $request['email'])->first();
        if (empty($check_email_exists)) {
            return response()->json(['error' => 'Email not exists.'], 200);
        }


        $check_email_exists->security_code           =  rand(1111, 9999);
        if ($check_email_exists->save()) {
            $project_name = env('App_name');
            $email = $request['email'];
            try {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    Mail::send('emails.user_forgot_password_api', ['name' => ucfirst($check_email_exists['first_name']) . ' ' . $check_email_exists['last_name'], 'otp' => $check_email_exists['security_code']], function ($message) use ($email, $project_name) {
                        $message->to($email, $project_name)->subject('User Forgot Password');
                    });
                }
            } catch (Exception $e) {
            }
            return response()->json(['message' => 'Email sent on registered Email', 'code' => 200]);
        } else {
            return response()->json(['message' => 'Something went wrong, Please try again later.', 'code' => 400]);
        }
    }

    public function reset_password(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'secret_key'       =>  'required|numeric',
                'email'      => 'required|email',
                'password'   => 'required',
                'confirm_password' => 'required_with:password|same:password'
            ]
        );
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }
        $email = $data['email'];
        $check_email = User::where('email', $email)->first();
        if (empty($check_email['security_code'])) {
            return response()->json(['message' => 'Something went wrong, Please try again later.', 'code' => 400]);
        }
        if (empty($check_email)) {
            return response()->json(['message' => 'This Email-id is not exists.', 'code' => 400]);
        } else {
            if ($check_email['security_code'] == $data['secret_key']) {
                $hash_password                  = Hash::make($data['password']);
                $check_email->password          = str_replace("$2y$", "$2a$", $hash_password);
                $check_email->security_code               = null;
                if ($check_email->save()) {
                    return response()->json(['message' => 'Password changed successfully', 'code' => 200]);
                } else {
                    return response()->json(['message' => 'Something went wrong, Please try again later.', 'code' => 400]);
                }
            } else {
                return response()->json(['message' => 'Something went wrong, Please try again later.', 'code' => 400]);
            }
        }
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $user =   auth()->userOrFail();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'user_name' => 'required|unique:users,user_name,' . @$user->id . ',id,deleted_at,NULL',
                'phone' => 'required|numeric',
                // 'email' => 'required|email|unique:users,email,' . @$user->id . ',id,deleted_at,NULL',
                'gender' => 'required',
                'dob' => 'required',
                'height' => 'required',
                'weight' => 'required',
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        $user =   auth()->userOrFail();
        $user->name = $data['name'];
        $user->user_name = $data['user_name'];
        $user->phone = $data['phone'];
        // $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->dob = $data['dob'];
        $user->height = $data['height'];
        $user->weight = $data['weight'];

        if (@$data['profile_pic']) {
            $fileName = time() . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('uploads'), $fileName);
            $user->profile_pic     = $fileName;
        }
        $user->save();
        return response()->json(['message' => 'Profile updated successfully', 'code' => 200]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'logout successfully', 'code' => 200]);
    }


    // public function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'code' => 200,
    //         'expire_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }
}
