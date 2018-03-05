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
/**
 * social login 社会化登录api
 */
Route::group(['prefix'=>'social'],function($router){
    require base_path('routes/social_login.php');
});

Route::get('print_fibonacci','AlgorithmController@print_fibonacci');

Route::get('/welcome', function () {
    //这里面有jquery生成二维码的插件
    return view('test');
});
Route::get('/view',function(){
   return view('home');
});
Route::any('test','TestController@test');
Route::any('time_test','TestController@time_test');//时间解析器测试
Route::any('test_validate','TestController@test_validate');//验证测试
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
Route::any('update_test','TestController@update_test');


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

Route::any('event',['uses'=>'ArticleController@chefs','as'=>'chefs_event']);

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
Route::any('data_merge',['uses'=>'DataTestController@data_merge']);//多个实例合并
Route::any('page_manage',['uses'=>'DataTestController@page_manage']);//分页使用
Route::any('arr_test',['uses'=>'DataTestController@arr_test']);//测试关联模型
Route::any('page_and_sum',['uses'=>'DataTestController@page_and_sum']);//测试关联模型
Route::any('assoc_mode',['uses'=>'DataTestController@assoc_mode']);//测试关联模型
Route::any('instance_reuse',['uses'=>'DataTestController@instance_use']);//一个实例多次使用
Route::any('data_test',['uses'=>'DataTestController@index']);
Route::any('collect_test',['uses'=>'DataTestController@collect_merge']);//集合合并测试

Route::any('get_article',['uses'=>'DataTestController@get_article']);

Route::any('regular_test',['uses'=>'DataTestController@regular_test','as'=>'regular_test']);
Route::any('ftest',['uses'=>'DataTestController@ftest','as'=>'f_test']);
Route::any('search',['uses'=>'DataTestController@search','as'=>'search']);
Route::any('cross_insert',['uses'=>'DataTestController@cross_insert','as'=>'cross_insert']);
/**
 * 常用函数封装
 */
Route::any('func',['uses'=>'CommonFuncController@index']);

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
    $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjlhZDkyODI4MjRmMDkzY2E3YjdhYWQ5YWFhNjYyYWE4ZDZiMTZkZGVmZDQ1ZmJhZTE0NzRjMWM5ZmNiNGZiY2ZlMGIxMDYyYTY1YTAwZWZiIn0.eyJhdWQiOiI2IiwianRpIjoiOWFkOTI4MjgyNGYwOTNjYTdiN2FhZDlhYWE2NjJhYThkNmIxNmRkZWZkNDVmYmFlMTQ3NGMxYzlmY2I0ZmJjZmUwYjEwNjJhNjVhMDBlZmIiLCJpYXQiOjE1MTA4ODUxMDQsIm5iZiI6MTUxMDg4NTEwNCwiZXhwIjoxNTEwOTcxNTA0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.MQfdESr78tMqtAc-rs2I8RKKQcQSsD8RKRhep9wn2IcrqKMYWbe32mIii3PSXxuPqFxmugW5p7PURe6FEQK3gOJRqNvQ7Sdjukp_wQZnVP5GW6JZpF8BPPoUeAAK1TusHi7cMADvFthWhSJqgSDL40hPhNWmlmIQmiayEVrGcQfLyVWXkokuICwVqqsRxrxINiYsVLwahZZ_PRKDLpUZkWhM-F37hWfpojePlyyXNDTMR47idAiQu9GwBnzYmOTY-MUAu-7YemB0KwCwytCLej-R64eq4mqG2wW0HpJGtq32PZsFqWt7wLCJiEiocSlqnD635blJM7gFaOsizwbvVJSfAiSGHXI31mk_PI4mrM6romLUagchlsZ_k9vRTx_BtDkrYs9-kCUx8aOzpsyCq__jskf0TyImJhP8iH6dNin4Tv4tbmy-XxWCYW7j_ylex5gidmP2ESjk2KF42qiwh-r1Q7WMeXwKwf7XpJSYaUurvf1zladjd9-2GLCuWN1IJMVfkoD4Pptm4GvEFLlagpUEmvACa3AcJVITYHFDmTAd6GB16iPK0rj0MjLP_00EtXk1DzhrwfniiJSfVYhJMgC1zgS1N18bb9NY9vaUxgzVFB5ezejYamMX6DOkK9ZekzfzemNhwRLTt8naA90TZGISvPOUZ1UzUFvv7WfkyOE';
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
Route::any('recommend',['uses'=>'RecommentController@index','as'=>'recommend']);

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
    Route::any('/is_continuity','AlgorithmController@is_continuity');
    Route::any('/name_convert','AlgorithmController@name_convert');
    Route::any('/get_sort_data','AlgorithmController@get_sort_data');//算法，计算学生的成绩排名
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
Route::any('vue_form',function(){
    return view('vue.index');
});
//vuex vuerouter aoisx测试

Route::get('/news', function() {
    return [
        ['id' => 1, 'title' => 'new1'],
        ['id' => 2, 'title' => 'new2'],
        ['id' => 3, 'title' => 'new3'],
        ['id' => 4, 'title' => 'new4'],
    ];
});
Route::get('/newslist', function() {
    return [
        ['id' => 1, 'title' => 'new1'],
        ['id' => 2, 'title' => 'new2'],
        ['id' => 3, 'title' => 'new3'],
        ['id' => 4, 'title' => 'new4'],
    ];
});
Route::get('/newsdetail/{id}', function($id) {
    return [
        'id' => 1,
        'title' => 'news',
        'content' => 'content',
        'created_at' => date('Y-m-d H:i:s')
    ];
});






/**
 * 搜索功能算法
 */
Route::any('search','SearchController@index');

/**
 * 生成页面
 */
Route::any('html','HtmlController@index');

/**
 * vue数据获取
 */
Route::any('vue_data','VueController@index');


/**
 * ueditor 百度编辑器
 */
Route::any('ueditor','OneController@ueditor');


//可输入的下拉框
Route::any('select_input',function(){
    return view('select_input');
});

/**
 * elasticsearch  全文搜索
 */
Route::any('make_index','ElasticSearchController@make_index'); //创建索引
Route::any('elasticsearch','ElasticSearchController@index'); //插入索引数据
Route::any('get_document','ElasticSearchController@get_document');//get_document

Route::any('search_for_doc','ElasticSearchController@search_for_doc');//search_for_doc



Route::any('search_for_doc','ElasticSearchController@search_for_doc');//搜索文档
Route::any('del_doc','ElasticSearchController@del_doc');//删除文档
Route::any('del_index','ElasticSearchController@del_index');//删除索引（删除整个索引，要比文档范围更大）


/**
 * xunsearch  应用测试
 */
Route::get('/xunsearch/{key}', function ($key){
    //config_path('search-demo.ini')
    $path = dirname(dirname(__FILE__)).'/config/search_demo.ini';

    $xs = new XS($path);


    $search = $xs->search; // 获取 搜索对象
    $query = $key;

    $search->setQuery($query)
        ->setSort('chrono', true) //按照chrono 正序排列
        ->setLimit(20,0) // 设置搜索语句, 分页, 偏移量
    ;

    $docs = $search->search(); // 执行搜索，将搜索结果文档保存在 $docs 数组中

    $count = $search->count(); // 获取搜索结果的匹配总数估算值
    foreach ($docs as $doc){
        $id = $doc->pid;
        $subject = $search->highlight($doc->subject); // 高亮处理 subject 字段
        $message = $search->highlight($doc->message); // 高亮处理 message 字段
        echo $doc->rank() . '. ' . $subject . " [" . $doc->percent() . "%] - ";
        echo date("Y-m-d", $doc->chrono) . "<br><a href='javascript:;' title=".$id." data-id='".$id."' >去查看</a>" . $message . "<br>";
        echo '<br>========<br>';
    }
    echo  '总数:'. $count;
});

Route::get('/makedoc/{title}/{message}', function ($title, $message){
    $xs = new XS('demo');
    $doc = new XSDocument;
    $doc->setFields([
        'pid' => 1,
        'subject' => $title,
        'message' => $message,
        'chrono' => time(),
    ]); // 用数组进行批量赋值
    $xs->index->add($doc);
});
Route::get('clear_index','SearchController@clear_index');
Route::get('create_index','SearchController@create_index');
// 8大排序

Route::get('sort1',['uses'=>'EightSortController@InsertSort']);//简单
Route::get('sort2',['uses'=>'EightSortController@ShellSort']);//希尔
Route::get('sort3',['uses'=>'EightSortController@SelectSort']);//选择
Route::get('sort4',['uses'=>'EightSortController@BubbleSort']);//冒泡
Route::get('sort5',['uses'=>'EightSortController@QuickSort']);//快速
Route::get('sort6',['uses'=>'EightSortController@MergeSort']);//归并
Route::get('sort7',['uses'=>'EightSortController@InsertSort']);
Route::get('sort8',['uses'=>'EightSortController@InsertSort']);

//sql语句测试
Route::get('sql',['uses'=>'CommonSqlController@sqlTest']);
Route::get('complex_sql',['uses'=>'CommonSqlController@complex_sql']);
Route::get('complex_sql2',['uses'=>'CommonSqlController@complex_sql2']);
Route::get('complex_sql3',['uses'=>'CommonSqlController@complex_sql3']);
Route::get('complex_sql4',['uses'=>'CommonSqlController@complex_sql4']);
Route::get('complex_sql5',['uses'=>'CommonSqlController@complex_sql5']);

//常用php 函数
Route::get('php_function',['uses'=>'PHPCommonFunctionController@php_function']);
Route::get('php_function2',['uses'=>'PHPCommonFunctionController@php_function2']);
Route::get('php_function3',['uses'=>'PHPCommonFunctionController@php_function3']);
Route::get('php_function4',['uses'=>'PHPCommonFunctionController@php_function4']);
Route::get('php_function5',['uses'=>'PHPCommonFunctionController@php_function5']);
Route::get('php_function6',['uses'=>'PHPCommonFunctionController@php_function6']);


