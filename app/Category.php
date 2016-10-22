<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    //
    public static function exists($name)
    {
        return Category::where('name', '=', $name)->get()->count();
    }
}
