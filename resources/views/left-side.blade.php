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
                    <div class="card">
                        <div class="card-image">
                            <img src="/img/posts/{{$post->coverPicName()}}">
                            <span class="card-title">{{$post->title}}</span>
                        </div>
                        <div class="card-content">
                            <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                            <a href="{{$post->slug}}">This is a link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if($i %2 == 0)
            <div class="row">
                @endif
                <div class="col s6">
                    <div class="card">
                        <div class="card-image">
                            <img src="http://teknogezegen.com/wp-content/uploads/2014/03/HELLOWORLD.gif">
                            <span class="card-title">Hello World</span>
                        </div>
                        <div class="card-content">
                            <p class="truncate flow-text">I am a very simple card. I am good at containing small bits of
                                information.
                                I am convenient because I require little markup to use effectively.
                                I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                </div>
                @if($i %2 == 1 || $i+1 == sizeof($posts))
            </div>
        @endif

    @endif
@endfor

