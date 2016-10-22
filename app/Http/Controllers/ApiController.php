<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

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
            $destination_path = 'img/posts';
            if($my_file->move($destination_path, $file_name))
                return response($file_name, 200);
            return response('Something went wrong!', 500);
        }
        else
            return response('File is not valid', 500);
    }
}
