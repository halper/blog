<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Post;
use App\Subscriber;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Image;

class ApiController extends Controller
{
    //
    public function addCategory(Request $request)
    {
        $name = ucwords(mb_strtolower($request->get('name')));
        if (Category::exists($name)) {
            $cat = Category::where('name', '=', $name)->first();
            return response(['id' => $cat->id, 'name' => $cat->name]);
        }
        $category = Category::create(['name' => $name]);
        return response(['id' => $category->id, 'name' => $category->name], 200);
    }

    public function fetchCategories()
    {
        return response(Category::all()->toArray(), 200);
    }

    public function addTag(Request $request)
    {
        $name = mb_strtolower($request->get('name'));
        if (Tag::whereName($name)->count()) {
            $cat = Tag::where('name', '=', $name)->first();
            return response(['id' => $cat->id, 'name' => $cat->name]);
        }
        $category = Tag::create(['name' => $name]);
        return response(['id' => $category->id, 'name' => $category->name], 200);
    }

    public function fetchPost(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $my_resp = [];
        $my_resp['category'] = '';
        if(count($post->category))
        $my_resp['category'] = $post->category->id;
        $my_resp['title'] = $post->title;
        $my_resp['body'] = $post->body;
        $tags = [];
        foreach ($post->tags as $tag) {
            $tags[] = $tag->name;
        }
        $my_resp['tags'] = $tags;
        $my_resp['published'] = !empty($post->published);
        return response($my_resp, 200);
    }

    public function fetchTags()
    {
        $tags = [];
        foreach (Tag::all() as $tag) {
            $tags[] = $tag->name;
        }
        return response($tags, 200);
    }

    public function uploadFile(Request $request)
    {
        if ($request->file('file')->isValid()) {
            $my_file = $request->file('file');
            $extension = $my_file->getClientOriginalExtension();
            $file_name = '';
            do {
                $file_name = uniqid(rand(), true) . ".$extension";
            }while(File::where('name', '=', $file_name)->count());
            $my_path = '/../../../public/';
            $destination_path = $my_path . 'img/posts';
            if($my_file->move($destination_path, $file_name)){
                $feature_img = File::create(['name' => $file_name]);
                if($feature_img)
                    return response($feature_img->id, 200);
                else{
                    unlink($destination_path . $file_name);
                    return response('Something went wrong with database!', 500);
                }
            }
            return response('Something went wrong!', 500);
        }
        else
            return response('File is not valid', 500);
    }

    public function saveSubscription(Request $request)
    {
        $subscription = Subscriber::create($request->all());

        return $subscription ? response('Success', 200) : response('Something went wrong', 500);
    }

    public function getPublishStatus(Request $request)
    {
        $post = Post::find($request->id);
        return response(!empty($post->published) ? 'true' : 'false', 200);
    }
}
