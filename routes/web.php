<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $post = Post::create(['name' => 'my First Post']);

    $post->tags()->save(Tag::findOrFail(1));
    $video = Video::create(['name' => 'myFirstmovie.mov']);
    $video->tags()->save(Tag::findOrFail(2));
});
Route::get('/read', function () {
    $post = Post::findOrFail(1);
    $video = Video::findOrFail(1);
    echo 'POST </br>';
    foreach ($post->tags as $tag) {
        echo $post->name . ' tag: ' . $tag->name . '<br>';
    }
    echo 'Video </br>';
    foreach ($video->tags as $tag) {
        echo $video->name . ' tag: ' . $tag->name . '<br>';
    }
});
Route::get('/update', function () {
    $post = Post::findOrFail(1);
    $video = Video::findOrFail(1);

    foreach ($post->tags as $tag) {
        $tagname = $tag->name;
        $tag->update(['name' => 'Updated ' . $tagname]);
    }

    foreach ($video->tags as $tag) {
        $tagname = $tag->name;
        $tag->update(['name' => 'Updated ' . $tagname]);
    }
});
Route::get('/delete', function () {
    $post = Post::findOrFail(1);
    $video = Video::findOrFail(1);

    foreach ($post->tags as $tag) {

        $tag->delete();
    }

    foreach ($video->tags as $tag) {

        $tag->delete();
    }
});
