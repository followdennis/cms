<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTestController extends Controller
{
    //
    function index(Request $request){
        //聚合排序
        $res = DB::table('data_test')
            ->select('cate',DB::raw('sum(num) as total'))
            ->groupBy('cate')
            ->orderBy('total','desc')
            ->get()->toArray();
//        $res = $request->except('_method');
        echo "<pre>";
//        print_r($res);
        //单词分界符
        $pattern = '~\bA\b~';
        $str="(A+AB+ABC+(B+BC))*A/B";
        echo $str."<br/>";
        $out = preg_replace($pattern,'',$str);
        print_r($out);
    }

    public function regular_test(){
        $path='#^[+/0-9A-Za-z]{21}[AQgw]==$#';
        $b='0ssfedfewfewfwefefewfA==#wefew';
        preg_match_all($path,$b,$out);

        print_r($out);
        echo '<br/>';
        $str = 'abcd';
        $pat = '#a#';
        $return = preg_match($pat,$str);
        print_r($str);
        $p = '#^(?:\w+\.)*?(\w+)\.(?:com.cn|cn|com|net)#';
        $str = 'baidu.com.cn';
        preg_match_all($p,$str,$out);
        print_r($out);
    }

    //辅助函数测试
    public function ftest()
    {
        //url使用的时候路由前面的部分
        echo url('ftest');
        echo '<br/>';
        //route 使用的是后面的as部分的内容
        echo route('f_test');
    }
    /**
     * 辅助函数
     */
    public function auxiliary()
    {
        //用方法反求出 url
        $url = action('DataTestController@index');
        echo 'action';
        echo $url;
        echo '<br/>url';
        echo url('user/profile',['id'=>1,'name'=>'xioaming']);//这样传递的内容，下标无效果
        echo '<br/>';
        echo 'route';
        echo "<br/>";
        echo route('test',['cate1'=>1,'cate2'=>'xiaoming','p'=>10]); //这种写法比较严格
        echo "<br/>";
        echo str_limit('处理完成，请处理', 8);
        echo '各种路径<br/>';
        echo public_path();
        echo "<br/>";
        echo storage_path();
        echo "<br/>";
        echo database_path();
        echo "<br/>";
        echo app_path();
        //retry 没什么效果
        echo "<br/>";
        echo "getByNameUri---这个会获取包括路由中的参数，但不包括可选参数  ？<br/>";
        echo app('router')->getRoutes()->getByName('test')->uri();

        $route = 'test/{cate1}-{cate2}-{p}.html';
        preg_match_all("/\{([\w+]+)\}/",$route,$route_var);
echo "<br/><pre>";
        print_r($route_var[1]);
echo "<br/>";
        $i = 0;
        retry(5,function() use($i){
            echo $i;
            echo '5';
        },1000);

    }
}
