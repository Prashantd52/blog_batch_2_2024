<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ValidationTrait
{
    public function validateUser(Request $request)
    {
        $user = DB::table('connection_requests')->where('connection_id',$request->connection_id)->where('auth_code',$request->auth_code)->first();
        if($user)
        {
            return $user;
        }
        else
        {
            return false;
        }
    }
}