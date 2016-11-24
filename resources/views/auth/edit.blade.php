@extends('auth.post')

@section('post-content')
    <div id="post-app" class="container">
        <div class="row">
            <div class="col s8">
                <div class="row">
                    <div class="input-field col s12">
                        <select v-model="postSelected" @change="postSelect()" class="browser-default">
                        @foreach(\App\Post::orderBy('created_at', 'DESC')->get() as $blog_post)
                            <option v-bind:value="{{$blog_post->id}}">{{ $blog_post->title }}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="hasPostSelected">
            @include('auth._post-form')
        </div>
    </div>
@stop