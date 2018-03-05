<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgorithmController extends Controller
{

    //算法测试
    public $arr = [
        [1,2],
        [3,4,5],
        [7,8,9]
    ];
    //斐波那契额数列测速
    public function print_fibonacci(){

        $time = microtime(true);
        $n = 10;
        echo "n=".$n."<br/>";
        echo $this->fibonacci($n);
        echo "<br/>";
        $end = microtime(true);
        echo $end-$time;
    }

    public function fibonacci($n){
        if($n < 2){
            return $n;
        }
        return $this->fibonacci($n -1) + $this->fibonacci($n-1);
    }
    public function name_convert(){
        $name = 'case_investigation_report';
        echo $this->convertUnderline($name);
    }

    //蛇形的写法 转化成 驼峰式写法
    public function convertUnderline ( $str , $ucfirst = true)
    {
        $str = explode('_' , $str);
        foreach($str as $key=>$val)
            $str[$key] = ucfirst($val);

        if(!$ucfirst)
            $str[0] = strtolower($str[0]);

        return lcfirst(implode('' , $str));
    }
    //切割数组
    public function div_arr(){
        $arr = [1,2,3,4,5,6,7,9,10,11,12,16,17,18,20,21];

    }
    //升序数字是否连续
    public function is_continuity($num = [1,2,9,3,5,4,6]){
        sort($num);
        $last = last($num);
        $head = head($num);
        if(count($num) == ($last-$head+1)){
            echo "连续";
        }else{
            echo "间断";
        }
    }

    //
    public function index(){
        $arr = $this->arr;
        $a = [];
        $all = 1;
        $height = count($arr);
        foreach($arr as $k => $v){
            $a[$k]['all']=count($v);
            $a[$k]['n'] = 0;
            $all *= count($v);
        }
        $new_arr = [];
        for($i = 0; $i < $all; $i++){
            $data = 0;
            for($h = 0 ; $h < $height; $h++){
//                $data +=$arr[$h][0];

                for($a[$h]['n'] = 0; $a[$h]['n'] < $a[$h]['all'];$a[$h]['n']++){

                }
//                $data +=$arr[$h][$a[$h]['n']];
            }
            array_push($new_arr,$data);
        }


        for($n = 0; $n < $all; $n++){

        }
        echo "<br/>";

        $new_arr = $this->add($arr);
        dd($new_arr);
    }
    public function jump(){

    }

    /**
     * 非递归计算 选择功能
     * @param $sets
     * @return array
     */
    function add($sets)
    {
        $result = array();
        for ($i=0, $count=count($sets); $i<$count-1; $i++) {
            if ($i == 0) {
                $result = $sets[$i];
            }
            //保存临时数据
            $tmp = array();
            foreach ($result as $res) {
                foreach ($sets[$i+1] as $set) {
                    $tmp[] = $res+$set;
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    //对数组类型的数据进行排序
    public function get_sort_data(){
        $data = [];
        for($i = 0; $i < 50; $i++){
            array_push($data,[
                'name'=>$i."--".str_random(10),
                'chinese'=>rand(70,100),
                'math'=>rand(70,100),
                'english'=>rand(70,100)
            ]);
        }
        echo "<pre>";
        print_r($data);
        echo "<hr/>";
        $new_data = [];
        $i = 0;
        foreach($data as $k => $v){
            if($v['chinese'] > 80 && $v['math'] > 80 && $v['english'] > 80 ){
                $v['sum'] = $v['chinese'] + $v['math'] + $v['english'];
                array_push($new_data,$v);
                ++$i;
                if($i == 10){
                    break;
                }
            }
        }
        usort($new_data,function($a,$b){
            if($a['sum'] == $b['sum']){
                return 0;
            }else if($a['sum'] > $b['sum']){
                return -1;
            }else{
                return +1;
            }
        });
        print_r($new_data);
    }

}
