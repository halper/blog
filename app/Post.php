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
        return $query->where('published', '=', 1)->where('published_on', '<=', Carbon::now())->orderBy('published_on', 'DESC');
    }

    public function coverPicName()
    {
        return $this->files()->where('cover_pic', '=', 1)->first()->name;
    }

    public function getContent()
    {
        $body = str_replace('<p>', '', $this->getBody());
        preg_match_all('/<\b[^>]*>/i', $body, $matches, PREG_OFFSET_CAPTURE);
        $length = sizeof($body) > 150 ? 150 : sizeof($body);
        if (!empty($matches) && sizeof($matches[0]) > 0) {
            $length = $matches[0][0][1] < 150 ? $matches[0][0][1] : $length;
        }

        return preg_replace('/[!?:;,.]/i', '', preg_replace('/\s+$/i', '', substr($body, 0, $length))) . '...';
    }

    public function getBody()
    {
        $body = '<p>' . $this->body . '</p>';
        $body = $this->replaceCodeTag($body);
        return (preg_replace('/\r\n/i', '<br>', $body));
    }

    private function replaceCodeTag($body)
    {
        $pattern = '/(code:)(\w+)(:)/i';
        $replacement = '<pre><code class="language-' . '$2' . '">';
        $body = preg_replace($pattern, $replacement, $body);
        $pattern = '/(:code)/i';
        $replacement = '</code></pre>';
        $body = preg_replace($pattern, $replacement, $body);
        return $this->makeParagraphBetweenTags($body, "pre");
    }

    private function makeParagraphBetweenTags($body, $tag)
    {
        $pattern = '/(?<=<\/' . $tag . '>\n)([^<>]+)\n(?=<' . $tag . '>)/i';
        $replacement = '<p>$1</p>';
        return preg_replace($pattern, $replacement, $body);
    }
}
