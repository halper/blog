<?php
$posts = \App\Post::posted()->get();

?>

@for($i = 0; $i < sizeof($posts); $i++)
    <?php
    $post = $posts[$i];

    ?>
    @if($i == 0)

        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card hoverable">
                        <a href="{{$post->slug}}" class="story-card-link">
                            <div class="card-image">
                                <div class="story-image">
                                    <img src="/{{$post->slug}}/image">
                                </div>
                                <span class="card-title"
                                      style="text-transform: uppercase;
                                      padding: 20px 20px 5px 20px">{{$post->title}}</span>
                            </div>
                            <div class="card-content">
                                <p class="flow-text">{!! $post->getContent() !!}</p>
                            </div>
                        </a>

                        <div class="card-action">
                            <a href="{{$post->slug}}" class="left">Read more</a>

                            <div class="right">
                                    <span class="view-count">{{$post->viewed}}
                                        <i class="material-icons left">ic_remove_red_eye</i>
                                        </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if($i %2 == 1)
            <div class="row">
                @endif

                <div class="col s12 m6">
                    <div class="card hoverable">
                        <a href="{{$post->slug}}" class="story-card-link">
                            <div class="card-image">
                                <div class="story-image">
                                    <img src="/{{$post->slug}}/image">
                                </div>
                                <span class="card-title"
                                      style="text-transform: uppercase;
                                      padding: 20px 20px 5px 20px">{{$post->title}}</span>
                            </div>
                            <div class="card-content">
                                <p class="flow-text">{!! $post->getContent() !!}</p>
                            </div>
                        </a>

                        <div class="card-action">
                            <a href="{{$post->slug}}" class="left">Read more</a>

                            <div class="right">
                                    <span class="view-count">{{$post->viewed}}
                                        <i class="material-icons left">ic_remove_red_eye</i>
                                        </span>
                            </div>

                        </div>
                    </div>
                </div>

                @if($i %2 == 0 || $i+1 == sizeof($posts))
            </div>
        @endif

    @endif
@endfor

