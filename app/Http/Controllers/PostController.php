<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function getPostId(Request $request)
    {
        $post = Post::whereTitle($request->title)->first();
        if(!$post){
            $post = Post::create(['title' => $request->title]);
        }
        return response($post->id, 200);
    }

    public function save(Request $request)
    {
        dd($request->all());
    }

}
