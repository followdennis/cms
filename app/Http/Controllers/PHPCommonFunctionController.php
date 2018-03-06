<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PHPCommonFunctionController extends Controller
{
    //
    public function common_function(){
        //1 array_walk
        $arr = [
           'name'=>'aaa',
            'phone'=>'12343'
        ];
        $data = new \stdClass();
        array_walk($arr,function($v,$k)use(&$data){
             $data->where($k,'like',$v);
        });
    }
    public function php_function(){
        $data = ['bill'=>60,'mark'=>30,'must'=>45];
        $data3 = ['bill'=>60,'mark'=>30];
        $data2 = [
            ['name'=>'bill','age'=>60],
            ['name'=>'mark','age'=>30],
            ['name'=>'must','age'=>45],

        ];
        array_change_key_case($data,CASE_UPPER);
        $res = array_chunk($data,2,true);
        $res = array_column($data2,'name','age');
        $res = array_combine($data,$data2);//合并数组 第一个为键 第二个为值
        $res = array_count_values($data);
        $res = array_diff($data,$data3); //前面的一个减去后面的一个 array_diff_assoc() array_diff_key
        $res = array_fill(3,4,'aaa'); //下表为3 填充到7 值为 aaa
        $res = array_fill_keys(['a','b','c'],'aaa');//指定键名
        $res = array_filter($data,function($item){
            return $item == 60;
        });//返回的是数组
        $res = array_flip($data);//键值反转
        $res = array_intersect($data,$data3);//交集
        $res = array_key_exists('bill',$data);//判断建明是否存在
        $res = array_keys($data);//返回键名
        $res = array_map(function($v,$v2){
            return $v."--".$v2;
        },$data,$data3);//可以使用多个数组 未必要等长//array_merge()
        $res = array_merge_recursive($data,$data3);//递归的合并，如果有键名相同的，则合并
        $res = array_multisort($data,SORT_DESC);//多维或多个数组排序，改变数组本身的值
        $res = array_pad($data,5,'aaa'); //array_pop()删除最后一个 array_product  返回乘积
        $res = array_rand($data,2);
        $res = array_reduce($data,function($v1,$v2){
            return $v1.'--'.$v2;
        });//自定义，返回一个字符串
        $res = array_replace($data,$data3);//后面数组替换前面键名一样的数组
        $res = array_reverse($data);//以相反的方式返回数组
        $res = array_search(60,$data);//搜索并返回键名 array_shift array_slice
        $res = array_slice($data,2,1);//返回数组的部分
        $res = array_splice($data,2,1,'aa');//data 直接被修改 返回被截取删掉的数组
        //array_sum  array_unique array_unshift 在数组的开头插入一个或多个元素
        //array_values()
        $firstname = 'bill';
        $last = 'gates';
        $age = 50;
        $res = compact("firstname","last","age");
        $res = extract($res);
        echo $firstname;
//        $res = shuffle($data);//改变数组
        usort($data,function($a,$b){
            if($a == $b){
                return 0;
            }else if( $a < $b){
                return -1;
            }else{
                return 1;
            }
        });


        echo "<pre>";
        print_r($data);
    }
    public function php_str(){
        //addslashes 转义
        //chunk_split //
        $str = 'abcdefghijklmn';
        echo chunk_split($str,'2','-');
        //htmlspecialchars_decode();//转换成html实体
        //htmlspecialchars() //里面的html标签不会被解析
        //lcfirst  首字母小写
        //parse_str()把字符串解析到变量中
        echo "<br/>";
        echo str_pad($str,30,'ok',STR_PAD_LEFT);
        //str_repeat('ok',5);
        //str_split($str,2);//切分到数组中
        //stripos();大小写不敏感  strpos 大小写敏感 出现的第一次位置
        //strrev()  字符串反转
        //strripos() 字符串在另一字符串出现的最后一次位置 不敏感
        //strtr($str,'ab','cd'); 字符串中的某个值转换为另一个值
        //ucfirst  lcfirst
    }
}
