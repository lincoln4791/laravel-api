<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $result = Post::all();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $result = $post->save();

        if($result){
            return ["result"=>"Post Saved"];
        }
        else{
            return ["result"=>"Post Not Saved"];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $result = Post::find($id);
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $post = Post::find($id);

        if($post){
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();

            if($post){
                return ["result"=>"Post Updated"];
            }
            else{
                return ["result"=>"Post Not Updated"];
            }

        }
        else{
            return ["result"=>"Post Not Found"];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);

        if($post){
            $isPostDeleted= $post->delete();

            if($isPostDeleted){
                return ["result"=>"Post Deleted"];
            }
            else{
                return ["result"=>"Post Not Deleted"];
            }

        }
        else{
            return ["result"=>"Post Not Found"];
        }

    }


    public function getExternalPost()
    {
        //
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/2');

        if ($response->successful()) {
            $data = $response->json();

            $post = new Post;
            $post->id = $data['id'];
            $post->title = $data['title'];
            $post->description = $data['completed'];
            $post->created_at = null;
            $post->updated_at = null;


            return $post;
        } else {
            // Handle the error
            return 'Failed';
        }
        //return $data;
    }



}
