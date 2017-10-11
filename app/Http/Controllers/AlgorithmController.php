<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgorithmController extends Controller
{
    //算法测试
    public $arr = [
        [1,2],
        [3,4,5],
        [6,7]
    ];
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

        for($h = 0; $h < $height; $h++){
            $a[$h]['n']++;
            if($a[$h]['n'] = $a[$h]['all']){
                $a[$h]['n'] = 0;
//                $a[$h+1]['n']++;
            }
        }
dd($a);
        for($n = 0; $n < $all; $n++){

        }
    }

}
