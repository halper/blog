@extends('main')

@section('content')
    <div class="row">
        <div class="col s9">
            <div class="container">
                @include('left-side')
            </div>
        </div>

        <div class="col s3" id="right-side">
            @include('right-side')
        </div>


    </div>
@stop
