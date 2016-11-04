<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::bind('story', function ($slug) {
    return \App\Post::where('slug', '=', $slug)->first();
});

Route::get('post', function(){
    return view('auth.post');
});
Route::get('new-post', function(){
    return view('auth.new-post');
});
Route::get('edit', function(){
    return view('auth.edit');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{story}', function (\App\Post $post) {
    if(empty($post)) return redirect()->back();
    return view('story')->with('story', $post);
});

Route::get('/home', 'HomeController@index');

Route::post('/post/get-post-id', 'PostController@getPostId');
Route::post('/post/save', 'PostController@save');
