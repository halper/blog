<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;

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

    public function getCategoryName()
    {
        return count($this->category) ? $this->category->name : "Uncategorized";
    }

    public function getContent()
    {
        $body = str_replace('<p>', '', $this->getBody());
        $body = str_replace('</p>', '', $body);
        preg_match_all('/<\b[^>]*>/i', $body, $matches, PREG_OFFSET_CAPTURE);
        $length = strlen($body) > 150 ? 150 : strlen($body);
        if (!empty($matches) && sizeof($matches[0]) > 0) {
            $length = $matches[0][0][1] < 150 ? $matches[0][0][1] : $length;
        }

        return preg_replace('/[!?:;,.]+$/i', '', preg_replace('/\s+$/i', '', substr($body, 0, $length))) . '...';
    }

    public function getCoverImg()
    {
        $my_path = realpath(dirname(__FILE__)) . '/..';
        $img = Image::make($my_path . "/public/img/posts/" . $this->coverPicName());
        $width = 1440;
        $height = 535;
        return $img->fit($width, $height)->response('jpg');
    }

    public function getBody()
    {
        $body = $this->body;
        $body = $this->replaceCodeTag($body);
        $body = $this->replaceHtmlTags($body);
//        dd($body);
        return $body;
    }

    private function replaceHtmlTags($body)
    {
        $body = preg_replace('/href:(((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?@\-_=#])*):/i', '<a href="$1" target="_blank">', $body);
        $body = preg_replace('/:href/i', '</a>', $body);
        $html_tags = ['h4', 'h5', 'h6', '^p', 'italic', 'strong', 'ol', 'ul', 'li'];
        foreach ($html_tags as $html_tag) {
            if (strpos($html_tag, '^') !== false) {
                $html_tag = str_replace('^', '', $html_tag);
                $pattern = '/^(' . $html_tag . ':)/im';
            } else
                $pattern = '/(' . $html_tag . ':)/im';
            $body = self::replaceTagAndGetBody($html_tag, $pattern, $body);
        }
        $html_tags = [];
        foreach ($html_tags as $html_tag) {
            $pattern = '/(' . $html_tag . ':)/im';
            $body = self::replaceTagAndGetBody($html_tag, $pattern, $body);
        }
        $body = preg_replace('/br:/i', '<br>', $body);
        $body = preg_replace('/italic/i', 'i', $body);
        $body = preg_replace('/cde: /i', "<code>", $body);
        $body = preg_replace('/ :cde/i', "</code>", $body);
        return $body;
    }

    private function replaceTagAndGetBody($tag, $pattern, $body)
    {
        $replacement = "<$tag>";
        $body = preg_replace($pattern, $replacement, $body);
        $body = preg_replace('/(:' . $tag . ')/im', "</$tag>", $body);
        return $body;
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
