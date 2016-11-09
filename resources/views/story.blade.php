<?php
$site_url = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
$cover_pic_src = "img/posts/" . $story->coverPicName();
$cover_pic_url = $_SERVER['HTTP_HOST'] . "/$cover_pic_src";
?>
@extends('main')
@section('meta-prop')
    <meta property="og:title" content="{{$story->title}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="{{$story->getContent()}}"/>
    <meta property="og:url" content="http://{{$site_url}}"/>
    <meta property="og:image" content="http://{{$cover_pic_url}}"/>
@endsection
@section('page-specific-js')

@endsection
@section('content')
    <div class="center" id="story">
        <h1>{{$story->title}}</h1>

        <div class="row">
            <span style="font-weight: 300; color: #607D8B; font-size: 14pt; text-transform: uppercase; margin-bottom: 8px">{{$story->getCategoryName()}}</span>
        </div>

        <img class="responsive-img" src="{{$cover_pic_src}}" alt="Cover Pic">

        <div class="container">
            <br>

            <div class="row">
                <div class="col s12 left-align">
                    @for($i = 0; $i < sizeof($story->tags); $i++)
                        <span class="chip">{{$story->tags[$i]->name}}</span>
                    @endfor
                </div>
                <div class="row col s12">
                    {!! $story->getBody() !!}
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <ul class="share-buttons">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F{{$site_url}}&t="
                               title="Share on Facebook" target="_blank"
                               onclick="window.open('https://www.facebook.com/share.php?u=' + encodeURIComponent(document.URL)); return false;"><img
                                        alt="Share on Facebook" src="img/simple_icons_black/Facebook.png"></a></li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2F{{$site_url}}&text=:%20http%3A%2F%2Fwww.halperdm.com&via=halperdm"
                               target="_blank" title="Tweet"
                               onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img
                                        alt="Tweet" src="img/simple_icons_black/Twitter.png"></a></li>
                        <li><a href="https://plus.google.com/share?url=http%3A%2F%2F{{$site_url}}" target="_blank"
                               title="Share on Google+"
                               onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img
                                        alt="Share on Google+" src="img/simple_icons_black/google.png"></a></li>
                        <li><a href="https://getpocket.com/save?url=http%3A%2F%2F{{$site_url}}&title="
                               target="_blank" title="Add to Pocket"
                               onclick="window.open('https://getpocket.com/save?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img
                                        alt="Add to Pocket" src="img/simple_icons_black/Pocket.png"></a></li>
                        <li><a href="http://www.reddit.com/submit?url=http%3A%2F%2F{{$site_url}}&title="
                               target="_blank" title="Submit to Reddit"
                               onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img
                                        alt="Submit to Reddit" src="img/simple_icons_black/Reddit.png"></a></li>
                        <li>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2F{{$site_url}}&title=&summary=&source=http%3A%2F%2Fwww.halperdm.com"
                               target="_blank" title="Share on LinkedIn"
                               onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img
                                        alt="Share on LinkedIn" src="img/simple_icons_black/LinkedIn.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection