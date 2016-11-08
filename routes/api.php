<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/add-category', 'ApiController@addCategory');
Route::post('/add-tag', 'ApiController@addTag');
Route::post('/upload-file', 'ApiController@uploadFile');
Route::post('/fetch-post', 'ApiController@fetchPost');
Route::get('/fetch-categories', 'ApiController@fetchCategories');
Route::get('/fetch-tags', 'ApiController@fetchTags');
