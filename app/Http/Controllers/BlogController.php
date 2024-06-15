<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{

    public function getBlogs($id=null){
        //$blog = Blog::all();

        if($id){
            return Blog::find($id);
        }
        else{
            return Blog::all();
        }

    }

    public function addBlog(Request $request){
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $result = $blog->save();

        if($result){
            return ["result"=>"Blog Saved"];
        }
        else{
            return ["result"=>"Blog Not Saved"];
        }
    }

    public function updateBlog(Request $request){
        $blog = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $result = $blog->save();

        if($result){
            return ["result"=>"Blog updated"];
        }
        else{
            return ["result"=>"Blog Not updated"];
        }
    }

    public function deleteBlog(Request $request){
        $blog = Blog::find($request->id);
    
        $result = $blog->delete();

        if($result){
            return ["result"=>"Blog Deleted"];
        }
        else{
            return ["result"=>"Blog Not Deleted"];
        }
    }

    public function searchBlog($param){
        $blog = Blog::where('title','like','%'.$param.'%')->get();
    
        return $blog;
    }

}
