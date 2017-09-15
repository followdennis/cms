<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommentController extends Controller
{
    //
    public function index(){
        $demo_title= "简明现代魔法";
        $demo_arr_title= array("简单易懂的现代魔法","简单明了的现代魔法","简明扼要的古代魔法","不简单的现代魔法","很难懂的现代魔法");
        $new_array= $this->getSimilar($demo_title,$demo_arr_title);
//print_r($new_array);
        echo"与[$demo_title]最相关的前三个文章是：<br/>";
        for($j=0; $j<=2; $j++)
        {
            echo($j+1).":".$new_array[$j]."<br/>";
        }
    }

    public function getSimilar($title,$arr_title)
    {

        $arr_len= count($arr_title);
        for($i=0; $i<=($arr_len-1); $i++)
        {
        //取得两个字符串相似的字节数
        $arr_similar[$i] = similar_text($arr_title[$i],$title);
        }
        arsort($arr_similar); //按照相似的字节数由高到低排序
        reset($arr_similar); //将指针移到数组的第一单元
        $index= 0;
        $new_title_array = [];
        foreach($arr_similar as $old_index => $similar)
        {
            $new_title_array[$index] = $arr_title[$old_index];
            $index++;
        }
        return $new_title_array;
    }
}
