<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegularController extends Controller
{
    //正则测试
    public function index(){

        echo 'aaa';
        $pattern = '~\bA\b~';
        $str="(A+AB+ABC+(B+BC))*A/B";
        $out = preg_replace($pattern,'',$str);
        print_r($out);
    }
    public function index2(){
        $temp="abcd：efghi：jklm";
        $r = preg_replace('/([^：]+)：.*/', '$1', $temp);
        echo $r;
        //输出abcd
    }
    public function index3(){
        $str = '"ccc{"bbb"{“aaa":"bbb"},{"bb":"cc"}fdddd}eee"';
        $r = preg_replace('/([^{]+)({.*)/','$2',$str);
        $l = preg_replace('/(.*})([^}]+)/','$1',$str);
        echo $l;
        echo "<br/>";
        echo $r;
        echo "<br/>";
        //匹配中间位置
        $inner = preg_replace(array('/([^{]+)({.*)/','/(.*})([^}]+)/'),array('$2','$1'),$str);
        echo $inner;
    }
}
