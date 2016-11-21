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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('new-post', function () {
        return view('auth.new-post');
    });
    Route::get('edit', function () {
        return view('auth.edit');
    });
});

Route::post('/post/get-post-id', 'PostController@getPostId');
Route::post('/post/save', 'PostController@save');

Route::get('/{story}/image', function (\App\Post $post) {
    if (empty($post)) return redirect()->back();

    return $post->getCoverImg();
});

Route::get('/{story}', function (\App\Post $post) {
    if (empty($post)) return redirect()->back();
    if (!Auth::user()) {
        $post->viewed = $post->viewed + 1;
        $post->save();
    }
    return view('story')->with('story', $post);
});



