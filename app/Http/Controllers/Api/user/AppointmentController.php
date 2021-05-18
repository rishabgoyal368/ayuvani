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
use App\BookAppointmentReport, App\BookAppointment;
use Mail, Hash, Auth;

class AppointmentController extends Controller
{
    public function book_a_appointment(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_id' => 'required|numeric',
                'date'      => 'required',
                'time'      => 'required',
                'virtual_care_consulation' => 'nullable',
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
            $book_appointment =   BookAppointment::Create([
                                                    'user_id'   => $user->id,
                                                    'doctor_id' => $data['doctor_id'],
                                                    'date'      => date('Y-m-d H:i:s',strtotime($data['date'])),
                                                    'time'      => date('H:i:s',strtotime($data['time'])),
                                                    'virtual_care_consulation' => $data['virtual_care_consulation']
                                                    ]);
            if ($book_appointment) {
                return response()->json([
                    'message' => 'Appointment Booked Successfuly', 
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

    public function report(Request $request){
               $data = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_id'     => 'required|numeric',
                'transaction_id'=> 'required|numeric',
                'response'      => 'required',
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
            $book_appointment_report =   BookAppointmentReport::Create([
                                                    'user_id'   => $user->id,
                                                    'doctor_id' => $data['doctor_id'],
                                                    'transaction_id'      => $data['transaction_id'],
                                                    'response'      => $data['response']
                                                    ]);
            if ($book_appointment_report) {
                return response()->json([
                    'message' => 'Transaction Report Success', 
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
