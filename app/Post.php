<?php

namespace App;

use Carbon\Carbon;
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
        return $this->belongsToMany('App\File')->withPivot('cover_pic');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function coverPic()
    {
        return $this->files()->where('cover_pic', '=', 1)->first();
    }

    public function scopePosted($query)
    {
        return $query->where('published_on', '<=', Carbon::now())->orderBy('published_on', 'DESC');
    }

    public function coverPicName()
    {
        return $this->files()->where('cover_pic', '=', 1)->first()->name;
    }

    public function getBody() {
        $body = '<p>' . preg_replace('/\n/i', '<br>', $this->body) . '</p>';
        return $this->replaceCode($body);
    }

    private function replaceCode($body){
        $pattern = '/(code:)(\w+)(:)(.*?)(:code)/i';
        $replacement = '</p><pre><code class="language-'.'$2'.'">$4</code></pre><p>';
        return (preg_replace($pattern, $replacement, $body));
    }
}
