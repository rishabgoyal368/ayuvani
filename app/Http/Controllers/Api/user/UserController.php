<?php

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
                'message' => 'Something went wrong',
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
                'dob'           =>'nullable',
                'age'           =>'nullable',
                'address'       =>'nullable',
                'phone_no'      =>'nullable',
                'email'         =>'nullable',
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
            if(!empty($data['dob'])){
                $add_user_family_relation->dob           = $data['dob'];
            }
            if(!empty($data['age'])){

                $add_user_family_relation->age           = $data['age'];
            }
            if(!empty($data['address'])){

                $add_user_family_relation->address       = $data['address'];
            }
            if(!empty($data['phone_no'])){

                $add_user_family_relation->phone_no      = $data['phone_no'];
            }
            if(!empty($data['email'])){

                $add_user_family_relation->email         = $data['email'];
            }
            if ($add_user_family_relation->save()) {
                return response()->json([
                    'message' => 'Family Relation Added Successfully', 
                    'code' => 200
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong', 
                'code' => 400
            ]);
        } 
    }


}
