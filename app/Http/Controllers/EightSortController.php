<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EightSortController extends Controller
{
    public $arr = [3,5,2,9,4,0,1,6,8,7];
    //八大排序
    //直接插入
    public function InsertSort(){
        echo 'InsertSort<br/>';
        $s = microtime(true);
        $arr = $this->arr;
        for( $i = 0; $i < count($arr)-1; $i++){
            for($j = $i+1; $j < count($arr); $j++){
                if($arr[$i] > $arr[$j]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        echo implode('-',$arr);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);
    }
    //希尔排序
    public function ShellSort(){
        echo 'ShellSort<br/>';
        $s = microtime(true);
        $arr = $this->arr;
        $count = count($arr);
        $gap = floor($count/2);
        while($gap >= 1){
            for($i = $gap; $i< $count;$i++){
                for($j = $i-$gap; $j>=0;$j-= $gap){
                    if($arr[$j] > $arr[$j+$gap]){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j+$gap];
                        $arr[$j+$gap] = $temp;
                    }
                }
            }
            $gap = floor($gap/2);
        }
        echo implode('-',$arr);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);
    }
    public function SelectSort()
    {
        echo 'SelectSort<br/>';
        $s = microtime(true);
        $arr = $this->arr;
        $count = count($arr);
        for($i = 0; $i < $count-1; $i++){
            $min = $arr[$i];
            for($j = $i+1; $j < $count; $j++){
                if($arr[$j] < $min){
                    $temp = $arr[$j];
                    $arr[$j] = $min;
                    $min = $temp;
                }
            }
            $arr[$i] = $min;
        }
        echo implode('-',$arr);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);

    }
    //冒泡排序
    public function BubbleSort()
    {
        echo 'BubbleSort<br/>';
        $s = microtime(true);
        $arr = $this->arr;
        $count = count($arr);
        for($i = 1; $i < $count; $i++){
            for($j=0; $j < $count-$i; $j++){
                if($arr[$j] > $arr[$j+1]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }

        echo implode('-',$arr);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);
    }
    public function QuickSort()
    {
        echo 'quick<br/>';
        $s = microtime(true);
        $arr = $this->arr;
        $count = count($arr);
        $return = $this->quick($arr);
        echo implode('-',$return);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);
    }
    public function quick(&$arr){

        if(count($arr)> 1){
            $temp = $arr[0];
            $x = array();
            $y = array();
            $size = count($arr);
            for($i = 1; $i < $size ; $i++){
                if($arr[$i] >= $temp){
                    $y[] = $arr[$i];
                }else{
                    $x[] = $arr[$i];
                }
            }
            $x = $this->quick($x);
            $y = $this->quick($y);
            return array_merge($x,array($temp),$y);
        }else{
            return $arr;
        }
    }
    //归并排序
    public function MergeSort(){
        $s = microtime(true);
        echo 'merge<br/>';
        $arr = $this->arr;
        $end = count($arr)-1;
        $start = 0;
        $this->MSort($arr,$start,$end);
        echo implode('-',$arr);
        $d = microtime(true);
        echo "<br/>";
        echo ($d-$s);
    }
    public function MSort(&$arr,$start,$end){
        if($start < $end){
            $mid = floor(($start+$end)/2);
            $this->MSort($arr,$start,$mid);
            $this->MSort($arr,$mid+1,$end);
            $this->Merge($arr,$start,$mid,$end);
        }
    }
    public function Merge(&$arr, $start,$mid,$end){
        $i = $start;
        $j = $mid +1;
        $k = $start;
        $temp = array();
        while($i < $mid+1 && $j < $end +1){
            if($arr[$i] >= $arr[$j]){
                $temp[$k++] = $arr[$j++];
            }else{
                $temp[$k++] = $arr[$i++];
            }
        }
        while($i < $mid+1){
            $temp[$k++] = $arr[$i++];
        }
        while($j < $end+1){
            $temp[$k++] = $arr[$j++];
        }
        for($i = $start; $i <=$end; $i++ ){
            $arr[$i] = $temp[$i];
        }
    }

}
