<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TreeController extends Controller
{

    public $arr = array();
    public $icon = array('└─ ','├─ ','│　 ');
    public $ret = '';
    public $nbsp = " ";
    public $str ='';

    protected  $tmp = array(
        array('id'=>1 , 'name'=>'首页' , 'parent_id'=>'0'),
        array('id'=>2 , 'name'=>'新闻中心' , 'parent_id'=>'1'),
        array('id'=>3 , 'name'=>'娱乐新闻' , 'parent_id'=>'2'),
        array('id'=>4 , 'name'=>'军事要闻' , 'parent_id'=>'2'),
        array('id'=>5 , 'name'=>'体育新闻' , 'parent_id'=>'2'),
        array('id'=>6 , 'name'=>'博客' , 'parent_id'=>'1'),
        array('id'=>7 , 'name'=>'旅游日志' , 'parent_id'=>'6'),
        array('id'=>8 , 'name'=>'心情' , 'parent_id'=>'6'),
        array('id'=>9 , 'name'=>'小小说' , 'parent_id'=>'6'),
        array('id'=>10 , 'name'=>'明星' , 'parent_id'=>'3'),
        array('id'=>11 , 'name'=>'网红' , 'parent_id'=>'3')
    );
    public function __construct()
    {
        $this->init($this->tmp);
    }

    public function init($arr=array()) {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }
    //
    public function index(){
        $data = $this->arr;
        echo "<pre>";

//        $child = $this->get_child(1);
//        print_r($child);//返回数组
        $str = "\$spacer\$name";
        $tree_view = $this->get_tree(0,$str);
        foreach($tree_view as $v){
            //将字段中的name修改成带有-- 前缀的形式
            print_r($v);
        }
        echo print_r($this->tree2($data));
    }
    public function tree(){

    }

    public function tree2($data , $id = 0,$lev = 0, $pk = 'id'){
        static $son = array();
        foreach($data as $key => $val){
            if($val['parent_id'] == $id){
                $val['lev'] = $lev;
                $son[] = $val;
                $this->tree2($data, $val[$pk] , $lev+1);
            }
        }
        return $son;
    }

    public function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '') {
        $number = 1;
        //一级栏目
        static $son = array();
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                $j = $k = '';
                if ($number == $total) {
                    $j .= $this->icon[0];
                } else {
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[2] : '';
                }
                $spacer = $adds ? $adds . $j : '';
                $selected = $id == $sid ? 'selected' : '';
                @extract($value);
                $parent_id == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
                $this->ret .= $nstr;
                $data = $value;
                $data['name'] = $nstr;
                $son[$id] = $data;
                $nbsp = $this->nbsp;
                $this->get_tree($id, $str, $sid, $adds . $k . $nbsp, $str_group);
                $number++;
            }
        }
        return $son;
        return $this->ret;
    }

    public function get_child($myid) {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['parent_id'] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }
}
