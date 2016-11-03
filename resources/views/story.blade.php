@extends('main')

@section('content')
    <div class="center">
        <h1>{{$story->title}}</h1>

        <img src="img/posts/{{$story->coverPicName()}}" alt="">

        <div class="container">
            {!! $story->getBody() !!}
        </div>
    </div>

@stop