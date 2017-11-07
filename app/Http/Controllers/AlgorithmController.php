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

}
