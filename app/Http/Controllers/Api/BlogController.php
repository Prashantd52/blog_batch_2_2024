<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Traits\CommonFunction;
use App\Traits\ValidationTrait;

class BlogController extends Controller
{
    //
    use ValidationTrait,CommonFunction;
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

    public function upload_image(Request $request)
    {
        if($this->validateUser($request))
        {

            $image = $request->image;

            
            $path=$this->uploadBase64Image($image);
            $data=[
                'file_path'=>$path
            ];
            return response()->json(['status'=>'success','message'=>'Image Uploaded Succefully','data'=>$data]);
        }
        else
            return response()->json(['status'=>'error','message'=>'Invalid Connection']);
    }


}
