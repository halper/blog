<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Post;
use App\Subscriber;
use App\Tag;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title, ['unique' => false]);
        $post->body = $request->body;
        $post->published = 0;
        if(!empty($request->published) && $request->published === true) {
            $post->published = 1;
            $this->sendMail($post);
            if(empty($post->published_on))
                $post->published_on = Carbon::now()->toDateString();
        }
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
            $post->files()->detach();
            $post->files()->attach($cover_pic, ['cover_pic' => 1]);
        }
        $post->save();
        return response('Success!', 200);
    }

    private function sendMail($post)
    {
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            \Mail::send('emails.new-post', ['subscriber' => $subscriber, 'post' => $post], function ($m) use ($subscriber) {
                $m->from('h.alper.dom@gmail.com', 'H. Alper Döm');

                $m->to($subscriber->email, $subscriber->name . ' ' . $subscriber->surname)->subject('New Story from halperdom.com');

            });
        }
    }

}
