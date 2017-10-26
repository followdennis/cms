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
    //这里面有jquery生成二维码的插件
    return view('welcome');
});
Route::get('/view',function(){
   return view('home');
});
Route::any('test','TestController@test');
Route::any('/','TestController@test');
Route::get('/home', 'HomeController@index');
Route::get('/home2', 'HomeController@index2');

Route::get('/detail','HomeController@detail');
Route::any('sidebar',function(){
    return view('sidebar');
});
/**
 * 序列化测试
 */
Route::any('test_serialize','TestController@test_serialize');

Route::any('menu',['uses'=>'AdminController@menu','as'=>'menu']);
Route::any('maketable',['uses'=>'AdminController@maketable','as'=>'maketable']);

Route::any('test/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@test','as'=>'test'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);


Route::any('index/{cate1}-{cate2}-{p}.html',['uses'=>'AdminController@index','as'=>'index'])->where(['p'=>'[0-9]+','cate1'=>'[a-z]+','cate2'=>'[a-z]+']);
Auth::routes();

//array_walk()使用
Route::any('chefs',['uses'=>'AdminController@_query','as'=>'chefs']);


/**
 * 缓存测试
 */
Route::any('set_redis',['uses'=>'AdminController@setRedis','as'=>'set_redis']);
Route::any('get_redis',['uses'=>'AdminController@getRedis','as'=>'get_redis']);
Route::any('cache_set',['uses'=>'AdminController@cache_set','as'=>'cache_set']);
Route::any('cache_get',['uses'=>'AdminController@cache_get','as'=>'cache_get']);


/**
 * 文件处理
 */
Route::any('image',['uses'=>'UploadImageController@index','as'=>'image']);
Route::any('image_upload',['uses'=>'UploadImageController@index_basic','as'=>'image_upload']);
Route::any('del_file',['uses'=>'UploadImageController@del_file','as'=>'del_file']);
Route::any('all_files',['uses'=>'UploadImageController@all_files','as'=>'all_files']);
Route::any('file_save_data',['uses'=>'UploadImageController@file_save_data','as'=>'file_save_data']);
Route::any('file_get_data',['uses'=>'UploadImageController@file_get_data','as'=>'file_save_data']);

/**
 * 爬虫测试
 */
Route::any('spider_test',['uses'=>'TestController@spider_test','as'=>'spider_test']);
Route::any('spider',['uses'=>'TestController@spider','as'=>'spider']);

Route::any('red_packet',['uses'=>'TestController@red_packet','as'=>'red_packet']);

/**
 * 树结构测试
 */
Route::any('tree_test',['uses'=>'AdminController@tree_test','as'=>'tree_test']);
Route::any('tree2_test',['uses'=>'AdminController@tree2_test','as'=>'tree2_test']);

Route::any('tree_html',['uses'=>'AdminController@tree_html','as'=>'tree_html']);
/**
 * 树结构测试
 */
Route::any('tree',['uses'=>'TreeController@index','as'=>'tree']);
Route::any('tree_menu',['uses'=>'TreeController@index','as'=>'tree']);


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

Route::any('route_test/{province?}/{city?}/{district?}',['uses'=>'TestController@route_test','as'=>'reoute_tes']);

/**
 * 聚合函数测试
 */
Route::any('data_test',['uses'=>'DataTestController@index']);
Route::any('get_article',['uses'=>'DataTestController@get_article']);

Route::any('regular_test',['uses'=>'DataTestController@regular_test','as'=>'regular_test']);
Route::any('ftest',['uses'=>'DataTestController@ftest','as'=>'f_test']);

Route::any('search',['uses'=>'DataTestController@search','as'=>'search']);

/**
 * 辅助
 */
Route::any('auxiliary',['uses'=>'DataTestController@auxiliary','as'=>'auxiliary']);
Route::any('sets',['uses'=>'DataTestController@sets','as'=>'sets']);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cache', function () {
    return cache('key');
});


/**
 * 图片测试picture
 */
Route::any('picture_handle','ImageController@index');

/**
 * api测试
 */

Route::get('logina',function(){
   return view('logintest.index');
});
Route::get('loginb',function(){
    return view('logintest.test');
});
Route::get('loginc',function(){
    return view('logintest.test2');
});

//请求令牌
Route::get('mobile_token',function(){
    $query = http_build_query([
       'client_id' => '4',
        'redirect_uri' => 'http://localhost/api_redirect',
        'response_type'=>'json',
        'scope' => '',
    ]);
    return redirect('http://www.cms.cc/oauth/authorize?'.$query);
});


//手机等，第一方应用
Route::get('mobile_test',function(){

});


Route::get('/api_redirect', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://your-app.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '4',
            'client_secret' => '2LhTFOycBp4uzn32Lbz863x406GQEbIVN2DI1zwK',
            'redirect_uri' => 'http://www.cms.cc/api_route',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('api_route',function(){
    return 'api_redirect';
});

Route::get('api_pass',function(){
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://www.cms.cc/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '6',
            'client_secret' => '6iesBQZvIWfze6LAyAecu17iyiB2qkg4mWkaBSiJ',
            'username' => 'dennis@qq.com',
            'password' => '123456',
            'scope' => '',
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});
Route::get('api_user',function(\Illuminate\Http\Request $request){

    $http = new GuzzleHttp\Client;
    $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNGI3NDY3ZDc1YzUyMWE3MzYxMTg3MjA4MDBiNDM1NDE3YjkwNjY3MTk3M2NmNDUwNWM0NzQwOTc0ZmZiNTMyMTRjMGFhNGY0OTkwNDE3In0.eyJhdWQiOiI2IiwianRpIjoiYmI0Yjc0NjdkNzVjNTIxYTczNjExODcyMDgwMGI0MzU0MTdiOTA2NjcxOTczY2Y0NTA1YzQ3NDA5NzRmZmI1MzIxNGMwYWE0ZjQ5OTA0MTciLCJpYXQiOjE1MDUzNzAyMzEsIm5iZiI6MTUwNTM3MDIzMSwiZXhwIjoxNTA1NDU2NjMxLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.I0WlGfYS5DipuWBE2hmlcTmdUDfh3UCp8bDBoJZEv2JtbVd_H43iNu2AujzRslWYbYeXy9vEI6Us3N_DCbeOyW2aVDMmdzFeHrXs9rLuFNeLFYYH98fuoEYSjl4KFTpB2yP-TAk2EY1QNgwn-5NGidlZr7j5OhkaWB1HTLdwgZqV2_kapYDeAtD6MHbo72JJCMNAvDEPdAvRFziA_ntLxduLrrMNF7W-BLvepT79k6yqqWodxb037NpDMIQVPZ4J-18nMcxd530MPh3-yYFlT-T6vep7NPpZsiiK_TpkkuHuzKXmKnoKVhFanWjaiw0FKa2Y_hnNOdZRMBOO_e_ywuwj1ZHAG8TqyVIlJ5u7kF-mBBe3JUrc5sRWJqiZ-zbCHxNvpo8XMKIxs3XnfxknhTGujOsUsFcCN4dBZPN1LTN4SA_i0Dedax1i33HcxwDAXFI4t_VPFdc8XNUk5fN240PIZN4gWWEB1iDDfNnpMoJ7uG94qivkTdtE72Iq3U2oJhT5ntcGfPq9WTDeDrC8G2V9Ph-4rR_reSuz5KiGuC_yUXOEn40L1CPEe2suZypvGmd8c_5BxxQr1oHOq6EVxWZBxYXpogWVIggYHdyMmYGxJQOv4CEvEfhRRLQBnBZorFDElxuVszFPS9b26NBO-AAsVgjlgeDwI6hH5-C3eJ8';
    $response = $http->get('http://www.cms.cc/api/user',[
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    return json_decode((string) $response->getBody(),true);

});
/**
 * 相关性测试
 */
Route::any('recommend',['uses'=>'RecommentController@index','as'=>'recomment']);

/**
 * category分类测试
 */
Route::any('category',['uses'=>'CategoryController@index','as'=>'category']);
Route::any('json',['uses'=>'CategoryController@json','as'=>'json']);


/**
 * 正则匹配
 */
Route::group(['prefix'=>'regular'],function(){
    Route::any('index',['uses'=>'RegularController@index']);
    Route::any('index2',['uses'=>'RegularController@index2']);
    Route::any('index3',['uses'=>'RegularController@index3']);
});
/**
 * 机器学习
 */
Route::group(['prefix'=>'ai'],function(){
    Route::any('/',['uses'=>'AIController@index']);
});


/**
 * 算法
 * AlgorithmController
 */

Route::group(['prefix'=>'calculate'],function(){
    Route::any('/',['uses'=>'AlgorithmController@index']);
});

/**
 * 动态路由
 * 这个路由必须定义才可以走
 */
Route::any('doctor/{name?}/search','OneController@index');
Route::any('actiontwo','TwoController@index');

/**
 * vue界面
 */
Route::any('vue',function(){
    return view('vue.example');
});