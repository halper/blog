@extends('main')
@section('page-specific-js')

@endsection
@section('content')
    <div class="center" id="story">
        <h1>{{$story->title}}</h1>

        <img class="responsive-img" src="img/posts/{{$story->coverPicName()}}" alt="">

        <div class="container">
            {!! $story->getBody() !!}
        </div>
    </div>

@stop