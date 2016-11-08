<?php
$posts = \App\Post::posted()->get();

?>

@for($i = 0; $i < sizeof($posts); $i++)
    @if($i == 0)
        <?php
                $post = $posts[$i];

                ?>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img src="/img/posts/{{$post->coverPicName()}}">
                            <span class="card-title">{{$post->title}}</span>
                        </div>
                        <div class="card-content">
                            <p class="flow-text">{!! $post->getContent() !!}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{$post->slug}}">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if($i %2 == 0)
            <div class="row">
                @endif

                @if($i %2 == 1 || $i+1 == sizeof($posts))
            </div>
        @endif

    @endif
@endfor

