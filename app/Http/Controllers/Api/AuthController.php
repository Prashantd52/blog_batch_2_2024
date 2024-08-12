<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function get_connection(Request $request)
    {
        $app_key = $request->app_key;
        if($app_key == 'BlogBATCH@2024SECOND')
        {
            $connection_id = rand(100000000000,999999999999);

            DB::table('connection_requests')->insert(['connection_id'=>$connection_id]);

            return response()->json([
                'status'=>'success',
                'data'=>[
                    'connection_id'=>$connection_id
                ],
                'message'=>'Connection Created'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>'error',
                'data'=>[],
                'message'=>'Invalid App Key'
            ]);
        }
    }

    public function login(Request $request)
    {
        $connection_id = $request->connection_id;

        $connection_exist = DB::table('connection_requests')->where('connection_id',$connection_id)->first();

        if($connection_exist)
        {
            $email = $request->email;

            $user = DB::table('users')->where('email',$email)->first();

            if($user)
            {
                $auth_code = rand(100000000,999999999);
                DB::table('connection_requests')->where('connection_id',$connection_id)->update(['auth_code'=>$auth_code,'user_id'=>$user->id]);

                $user->connection_id = $connection_id;
                $user->auth_code = $auth_code;
                return response()->json([
                    'status'=>'success',
                    'data'=>[
                        'user'=>$user
                    ],
                    'message'=>'User Login Successfully'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'data'=>[],
                    'message'=>'User Not Found'
                ]);
            }
        }
        else
        {
            return response()->json([
                'status'=>'error',
                'data'=>[],
                'message'=>'Invalid Connection ID'
            ]);
        }
        
    }
}
