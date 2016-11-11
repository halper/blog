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
                            <span class="card-title"><strong style="text-transform: uppercase">{{$post->title}}</strong></span>
                        </div>
                        <div class="card-content">
                            <p class="flow-text">{!! $post->getContent() !!}</p>
                        </div>
                        <div class="card-action">
                            <div class="row">
                                <div class="col s9">
                                    <a href="{{$post->slug}}">Read more</a>
                                </div>
                                <div class="col s3">
                                    <span class="view-count">{{$post->viewed}}
                                        <i class="material-icons left">ic_remove_red_eye</i>
                                        </span>
                                </div>
                            </div>
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

