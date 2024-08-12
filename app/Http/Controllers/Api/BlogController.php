<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

use App\Traits\ValidationTrait;

class BlogController extends Controller
{
    //
    use ValidationTrait;
    public function blog_list(Request $request)
    {
        //validate user
        $user = $this->validateUser($request);
        if($user)
        {
            $blogs = Blog::all();
    
            if(count($blogs) == 0)
            {
                return response()->json([
                    'status'=>'error',
                    'data'=>[],
                    'message'=>'No Blog Found'
                ]);
            }
    
            return response()->json([
                'status'=>'success',
                'data'=>$blogs,
                'message'=>'Blog List'
            ]);
        }
        else
            return response()->json([
                'status'=>'error',
                'data'=>[],
                'message'=>'Invalid Connection'
            ]);
    }
}
