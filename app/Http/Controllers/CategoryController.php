<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
         $categories = Category::where('parent_id', '=', 0)->get();
        foreach($categories as $k => $v){
            echo "<br>";
            echo $v->id."&nbsp&nbsp&nbsp&nbsp".$v->name;
            if(count($v->childs)){
//               dd($v->childs->toArray());
                echo "<pre/>";
              print_r($v->childs->toArray());
            }

        }
    }
    public function json(){
        $data = 'aaa{{"title":"\u9996\u9875"}{ddd}bbb}';
//      preg_match('/(?:})(.*?)/',$data,$out);
//      preg_match('/(.*?)(?:{)/',$data,$out);
        echo preg_replace(['/(.*?)(?:{)/'],'',$data);
        echo "<br/>正则匹配第一个冒号钱的字符<br/>";
        $temp="abcd：efghi：jklm";
        $r = preg_replace('/([^：]+)：.*/', '$1', $temp);
        echo $r;
        echo "<br/>";
        $str = 'ccc{"bbb"{“aaa":"bbb"},{"bb":"cc"}fdddd}eee';
//        echo preg_replace('/([^\{]+)\}.*/','$1',$str);
        echo "<br/><pre>";
        preg_match('/.*?(?={)/',$str,$out);

        print_r($out);
    }

    /**
     * 没用上
     * @param $str
     * @return string
     */
    function unescape($str) {
        $str = rawurldecode($str);
        preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);
        $ar = $r[0];
        //print_r($ar);
        foreach($ar as $k=>$v) {
            if(substr($v,0,2) == "%u"){
                $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
            }
            elseif(substr($v,0,3) == "&#x"){
                $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
            }
            elseif(substr($v,0,2) == "&#") {
                $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
            }
        }
        return join("",$ar);
    }
}
