<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonFuncController extends Controller
{
    //常用函数封装
    public function index(){
        $arr1 = [
            ['a'=>'aaa','b'=>111],
            ['a'=>'fdfdf','b'=>222]
        ];
        $arr2 = [
            ['c'=>'cccc','d'=>'dddd'],
            ['c'=>'fdkfjldjf','d'=>'dfdfdf']
        ];
        $arr3 = [1,2];
        echo "<pre>";
        $mereg =  $this->addColumn($arr1,$arr3,false);
        print_r($mereg);
        $num = [3,1,2];
        sort($num);
        print_r($num);
    }

    /**
     * 2017-11-04
     * 两个等长的二位数组合并（可用）
     * select   true 则均为二位数组，false 表示arr2为一维数组
     * @param array $arr1 二维数组
     * @param array $arr2 二维数组
     */
    public function addColumn($arr1=array(),$arr2= array(),$select = true,$field = 'id'){
       if(!is_array($arr1) || !is_array($arr2)){
           return '';
       }
       if($select){
           foreach($arr1 as $k => &$v){
               foreach($arr2[$k] as $key => $val){
                   $v[$key] = $val;
               }
           }
       }else{
           foreach($arr1 as $k => &$v){
               $v[$field] = $arr2[$k];
           }
       }
       return $arr1;
    }
}
