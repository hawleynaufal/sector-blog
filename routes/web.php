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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['web']], function(){
  Route::get('post/{slug}',['as'=>'post.single' , 'uses' => 'PostController@getSingle'])->where('slug' , '[\w\d\-\_]+');
  Route::resource('blog','BlogController');
  Route::get('/home', 'HomeController@index');
  Route::get('/hawley' ,function(){
    echo ' hawley naufal ';
  });
});

Auth::routes();
