g<?php

namespace App\Http\Controllers\Api\user;
use App\Http\Controllers\Controller;
use JWTAuth;
use Validator;
use IlluminateHttpRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Admin;
use App\Relation, App\UserFamilyRelation;

class UserController extends Controller
{
    public function relation(Request $request)
    {
        $data = $request->all();

        try{
            $relations 	=   Relation::select('id','name')->get()->toArray();

            if ($relations) {
                return response()->json([
                    'message' => 'success', 
                    'code' => 200,
                    'data'=>$relations
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        }
    }

    public function relation_data(Request $request)
    {
        $data = $request->all();

        try{
            $user = auth()->userOrFail();
            $relations  =   UserFamilyRelation::where('user_id',$user['id'])->get()->toArray();

            if ($relations) {
                return response()->json([
                    'message' => 'success', 
                    'code' => 200,
                    'data'=>$relations
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        }
    }

    public function realtion_add(Request $request){
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'relation_id'   =>'required|numeric',
                'name'          =>'required',
                'dob'           =>'required|date',
                'age'           =>'required',
                'address'       =>'required',
                'phone_no'      =>'required',
                'email'         =>'required|email',
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        try{
            $user = auth()->userOrFail();
            $add_user_family_relation = new  UserFamilyRelation;
            $add_user_family_relation->user_id       = $user->id;
            $add_user_family_relation->relation_id   = $data['relation_id'];
            $add_user_family_relation->dob           = $data['dob'];
            $add_user_family_relation->name          = $data['name'];
            $add_user_family_relation->age           = $data['age'];
            $add_user_family_relation->address       = $data['address'];
            $add_user_family_relation->phone_no      = $data['phone_no'];
            $add_user_family_relation->email         = $data['email'];
            $add_user_family_relation->save();
                
            
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        } 
        return response()->json([
                    'message' => 'Family Relation Added Successfully', 
                    'code' => 200
                ]);
    }

       public function relation_edit(Request $request){
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'user_relation_id'   =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        try{
            $user                                       = auth()->userOrFail();
            $user_relation_id                            = $data['user_relation_id'];
            $user_family_relation_details                = UserFamilyRelation::find($user_relation_id);
            $user_family_relation_details->user_id       = $user->id;
            $user_family_relation_details->relation_id   = isset($data['relation_id']) ? $data['relation_id'] : $user_family_relation_details->relation_id;
            $user_family_relation_details->dob           = isset($data['dob']) ? $data['dob'] : $user_family_relation_details->dob;
            $user_family_relation_details->name          = isset($data['name']) ? $data['name'] : $user_family_relation_details->name;
            $user_family_relation_details->age           = isset($data['age']) ? $data['age'] : $user_family_relation_details->age;
            $user_family_relation_details->address       = isset($data['address']) ? $data['address'] : $user_family_relation_details->address;
            $user_family_relation_details->phone_no      = isset($data['phone_no']) ? $data['phone_no'] : $user_family_relation_details->phone_no;
            $user_family_relation_details->email         = isset($data['email']) ? $data['email'] : $user_family_relation_details->email;
            $user_family_relation_details->save();
                
            
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        } 
        return response()->json([
                    'message' => 'Family Relation Edited Successfully', 
                    'code' => 200
                ]);
    }

    public function relation_delete(Request $request){
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'user_relation_id'   =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        try{
            $user                                    = auth()->userOrFail();
            $user_relation_id                        = $data['user_relation_id'];
            $delete_user_relation                    = UserFamilyRelation::where('id',$user_relation_id)->delete();
                    
            
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        } 
        return response()->json([
                    'message' => 'Family Relation Deleted Successfully', 
                    'code' => 200
                ]);
    }



}
