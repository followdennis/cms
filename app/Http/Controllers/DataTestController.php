<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTestController extends Controller
{
    //
    function index(){
        $res = DB::table('data_test')
            ->select('cate',DB::raw('sum(num) as total'))
            ->groupBy('cate')
            ->orderBy('total','desc')
            ->get()->toArray();
        echo "<pre>";
        print_r($res);
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
}
