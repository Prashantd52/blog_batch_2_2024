<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class ReportController extends Controller
{
    //
    public function user_blogs()
    {

        $records = User::withcount('blogs')->with('latest_blog')
                        // ->whereHas('blogs',function($query) use (){
                        //     $query->where();
                        // })
                        ->whereHas('blogs')
                        ->get();

        $Blogs = Blog::select('id','created_at')->get();

        $monthWiseBlogs = [
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0
        ];

        foreach($Blogs as $record){
            $month = Date('m',strtotime($record->created_at));
            // dd($month);
            $monthWiseBlogs[$month] = $monthWiseBlogs[$month] + 1;
        }

        // dd($records,$monthWiseBlogs);
        return view('backend.reports.user_blogs',compact('records','monthWiseBlogs'));
    }
}
