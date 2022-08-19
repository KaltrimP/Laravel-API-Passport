<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function  showPosts(){
        return PostResource::collection(Post::all());
    }
    public function  showSinglePost($id){
        $post = Post::find($id);
        return response()->json($post);
    }

    public function store(Request $request){
        $post = new Post;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->author = $request->author;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();
    }

    public function delete($id){
        $post = Post::find($id);
        $post->delete();
    }

    public function searchPosts($name){
        return Post::where('title', 'like', '%'.$name.'%')->orWhere('author', 'like', '%'.$name.'%')->get();
    }

}
