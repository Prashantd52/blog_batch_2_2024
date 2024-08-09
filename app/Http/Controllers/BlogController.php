<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;

use App\Traits\CommonFunction;

class BlogController extends Controller
{
    use CommonFunction;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            // dd($reqiest);
            $limit=$request->length;
            $skip= $request->start;
            $totalCount = 0;

            $blogs = Blog::with(['category','tags']);

            $totalCount = $blogs->count();

            $blogs = $blogs->skip($skip)->limit($limit)->get();

            // dd($blogs);
            if(count($blogs) > 0)
            {
                foreach($blogs as $blog)
                {

                    $tags='';
                    // foreach($blog->tags as $tag)
                    // {
                    //     $tags .= $tag->name.', ';
                    // }
                    if(count($blog->tags) > 0)
                    {
                        $tags = implode(',',$blog->tags->pluck('title')->toArray());
                    }
                    $img='<img src="/'.$blog->cover_image.'" height="100px" >';

                    $action ='<a href="'.route('blogs.edit',$blog->id).'" title="edit" target="_blank"><i class="la la-edit"></i></a>';
                    $data[]=[
                        $blog->title,
                        $img,
                        $blog->category->name,
                        $blog->content,
                        $tags,
                        $blog->user_id,
                        $action,
                    ] ;
                }
            }
            else
            {
                $data = [];
            }

            $json_data = array(
                "draw"            => intval($request->draw),
                "recordsTotal"    => intval($totalCount),
                "recordsFiltered" => intval($totalCount),
                "data"            => $data  // total data array
            );

            echo json_encode($json_data);
            

        }
        else
            return view('backend.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.blogs.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $cover_image_path = 'hello';

        if(isset($request->blog_id))
        {
            $blog = Blog::find($request->blog_id);
        }
        else
        {
            $blog = new Blog;
        }

        if($request->hasFile('cover_image'))
        {
            $cover_image_path = $this->uploadFile($request->cover_image, 'uploads/blogs/');
        }

        // dd($cover_image_path);
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->cover_image = $cover_image_path;
        $blog->user_id = auth()->user()->id;
        
        $blog->save();

        $blog->tags()->sync($request->tags);

        return redirect()->route('blogs.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $blog = Blog::find($id);
        $blog = Blog::where('id','=',$id)->first();
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.blogs.create', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
