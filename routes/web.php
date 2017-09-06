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
Route::get('/view',function(){
   return 'view';
});
Route::any('test','TestController@test');
Route::get('/home', 'HomeController@index');
Route::get('/detail','HomeController@detail');
Route::any('sidebar',function(){
    return view('sidebar');
});
Route::any('menu',['uses'=>'AdminController@menu','as'=>'menu']);
Route::any('maketable',['uses'=>'AdminController@maketable','as'=>'maketable']);

Route::any('test/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@test','as'=>'test'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);


Route::any('index/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@index','as'=>'index'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);Auth::routes();

//array_walk()使用
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

Route::any('tree_test',['uses'=>'AdminController@tree_test','as'=>'tree_test']);

Route::any('tree_html',['uses'=>'AdminController@tree_html','as'=>'tree_html']);

//文章处理
Route::any('list',['uses'=>'ArticleController@index','as'=>'list']);
//文章详情
Route::any('show/{id}',['uses'=>'ArticleController@show','as'=>'show']);

Route::any('chefs_event',['uses'=>'ArticleController@chefs','as'=>'chefs_event']);

//百度地图
Route::any('baidu_map',['uses'=>'BaiDuMapController@index']);


Route::get('queue_test',['uses'=>'QueueController@queue_test']);

/**
 * 地图测试
 */
Route::any('baidu_map',['uses'=>'BaiDuMapController@index','as'=>'baidu_map']);

Route::any('route_test/{province?}/{city?}/{district?}',['uses'=>'TestController@route_test']);

/**
 * 聚合函数测试
 */
Route::any('data_test',['uses'=>'DataTestController@index']);

Route::any('regular_test',['uses'=>'DataTestController@regular_test','as'=>'regular_test']);
Route::any('ftest',['uses'=>'DataTestController@ftest','as'=>'f_test']);

/**
 * 辅助
 */
Route::any('auxiliary',['uses'=>'DataTestController@auxiliary','as'=>'auxiliary']);
