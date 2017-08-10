<?php

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

Route::get('/home', 'HomeController@index');
Route::get('/detail','HomeController@detail');
Route::any('sidebar',function(){
    return view('sidebar');
});
Route::any('menu',['uses'=>'AdminController@menu','as'=>'menu']);
Route::any('maketable',['uses'=>'AdminController@maketable','as'=>'maketable']);

Route::any('test/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@test','as'=>'test'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);


Route::any('index/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@index','as'=>'index'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);Auth::routes();

Route::any('chefs',['uses'=>'AdminController@_query','as'=>'chefs']);

Route::any('set_redis',['uses'=>'AdminController@setRedis','as'=>'set_redis']);
Route::any('get_redis',['uses'=>'AdminController@getRedis','as'=>'get_redis']);

Route::any('image',['uses'=>'UploadImageController@index','as'=>'image']);
Route::any('image_upload',['uses'=>'UploadImageController@index_basic','as'=>'image_upload']);

Route::any('del_file',['uses'=>'UploadImageController@del_file','as'=>'del_file']);


Route::any('all_files',['uses'=>'UploadImageController@all_files','as'=>'all_files']);

Route::any('spider_test',['uses'=>'TestController@spider_test','as'=>'spider_test']);
Route::any('spider',['uses'=>'TestController@spider','as'=>'spider']);

Route::any('red_packet',['uses'=>'TestController@red_packet','as'=>'red_packet']);



