<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;

class Tree{
    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    public $arr = array();

    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    public $icon = array('│','├','└');
    public $nbsp = "&nbsp;";

    /**
     * @access private
     */
    public $ret = '';

    public $str;

    public $newarr = array();

    public function init($arr){
        $this->arr = $arr;
    }

    public function get_child($myid){
        $children = array();
        if(is_array($this->arr)){
            foreach( $this->arr as $k => $v){
                if($v['pid'] = $myid){
                    $children[] = $v;
                }
            }
        }
        return $children;
    }

    public function get_parent(){

    }
    public function get_tree($arr = array(), $pid = 0, $deep = 0){

        if(is_array($arr)){
            foreach($arr as $k => $v){

            }
        }
    }

    function make_tree($list,$pk='id',$pid='pid',$child='_child',$root=0){
        $tree=array();
        $packData=array();
        foreach ($list as  $data) {
            $packData[$data[$pk]] = $data;
        }
        foreach ($packData as $key =>$val){
            if($val[$pid]==$root){//代表跟节点
                $tree[]=& $packData[$key];
            }else{
                //找到其父类
                $packData[$val[$pid]][$child][]=& $packData[$key];
            }
        }
        return $tree;
    }

    public function arr_foreach($arr)
    {
        if (!is_array ($arr))
        {
            return false;
        }
        foreach ($arr as $key => $val )
        {
            if (is_array ($val))
            {
                $this->arr_foreach ($val);
            }
            else
            {
                echo $val.'<br/>';
            }
        }
    }


}