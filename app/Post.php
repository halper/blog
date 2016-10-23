<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sluggable, SoftDeletes;

    protected $fillable = ['title', 'body', 'published', 'viewed', 'liked', 'shared', 'publish_date'];
    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function coverPic()
    {
        return $this->files()->where('cover_pic', '=', 1)->first();
    }
}
