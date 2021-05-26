<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use IlluminateHttpRequest;
use Illuminate\Http\Response;
use App\Blog;

class ContentController extends Controller
{
    public function blogs(Request $request)
    {
        $data = $request->all();

        try{
            $blogs 	=   Blog::select('id','title','description')->get()->toArray();
            if ($blogs) {
                return response()->json([
                    'message' => 'success', 
                    'code' => 200,
                    'data'=>$blogs
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        }
    }

    public function blog_details(Request $request){
        $data = $request->all();
 		
 		$validator = Validator::make(
            $request->all(),
            [
                'blog_id'   =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return response()->json($response);
        }

        try{
            $blogs 	=   Blog::where('id',$data['blog_id'])->select('id','title','description')->first();
            if ($blogs) {
                return response()->json([
                    'message' => 'success', 
                    'code' => 200,
                    'data'=>$blogs
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'code' => 400
            ]);
        }
    }
}
