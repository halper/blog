<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;


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
        $post = Post::findOrFail($request->post);
        $post->title = $request->title;
        $post->body = $request->body;
        if(!empty($request->published) && $request->published === true) $post->published = 1;
        if(!empty($request->category)){
            $category = Category::findOrFail($request->category);
            $post->category()->associate($category);
        }
        if(!empty($request->tags)){
            $post->tags()->detach();
            foreach($request->tags as $tag_name){
                $tag = Tag::getFromName($tag_name);
                $post->tags()->attach($tag);
            }
        }
        if(!empty($request->get('file'))){
            $cover_pic = File::findOrFail($request->get('file'));
            $post->files()->attach($cover_pic, ['cover_pic' => 1]);
        }
        $post->save();
        return response('Success!', 200);
    }

}
